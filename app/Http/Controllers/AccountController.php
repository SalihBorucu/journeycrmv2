<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountCampaign;
use App\Campaign;
use App\CampaignSchedule;
use App\Lead;
use App\LeadAccount;
use App\UserAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function create()
    {
        $account = Account::create([
            'name' => request('accountName')
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

        // $this->flashSuccess("Account created successfully");

        return response()->json();
    }
}
