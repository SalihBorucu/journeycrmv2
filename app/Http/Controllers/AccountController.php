<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Account;
use App\Campaign;
use App\Schedule;
use App\LeadAccount;
use App\UserAccount;
use App\AccountCampaign;
use App\CampaignSchedule;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $accounts = Account::with(['campaigns.campaignSchedules.schedule', 'userAccounts.user' ])->get();
        return view('admin.admin-accounts', compact('accounts'));
    }

    public function create()
    {
        $account = Account::create([
            'name' => request('accountName'),
            'complete' => false
        ]);

        $userAccounts = [];
        foreach (request('selectedUsers') as $key => $value) {
            $userAccounts[] = [
            'account_id' => $account->id,
            'user_id' => $value
            ];
        }

        UserAccount::insert($userAccounts);
        $campaignSchedules = [];

        foreach (request('campaigns') as $key => $value) {
            $campaign = Campaign::create([
                'account_id' => $account->id,
                'name' => $value['campaignName'],
                'description' => $value['campaignDescription']
            ]);

            foreach ($value['selectedSchedules'] as $k => $v) {
                $campaignSchedules[] = [
                    'campaign_id' => $campaign->id,
                    'schedule_id' => $v['id']
                ];

            }
        }

        CampaignSchedule::insert($campaignSchedules);

        return response()->json($account);
    }

    public function show($id){
        $account = Account::with(['campaigns.campaignSchedules.steps.template', 'userAccounts.user', 'campaigns.campaignSchedules.schedule'])->findOrFail($id);
        $users = User::all();
        $schedules = Schedule::where('type', 'standard')->get();

        return view('admin.admin-edit', compact('account', 'users', 'schedules'));
    }

    public function update($accountId){

        Account::findOrFail($accountId)->update([
            'name' => request('account_name')
        ]);

        foreach (request('selected_users') as $key => $value) {
            UserAccount::firstOrCreate([
                'user_id' => $value['id'],
                'account_id' => $accountId
            ]);
        }

        return response()->json();
    }

    public function publish($accountId){
        $account = Account::findOrFail($accountId);
        $account->update([
            'complete' => (int)request('state')
        ]);

        return response()->json($account);
    }
}
