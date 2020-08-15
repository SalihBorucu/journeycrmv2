<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;
use Carbon\Carbon;
use App\LeadAccount;
use App\ActivityHistory;
use App\Mail\ProspectEmail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ActivitiesController extends Controller
{
    public function index()
    {
        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->campaigns;

        return view('campaigns')->with([
            'campaigns' => $campaigns,
            'account' => $account->name
        ]);
    }

    public function show(Campaign $campaign)
    {
        $leads = LeadAccount::where('account_id', session()->get('user_current_account'))
            ->where('campaign_id', $campaign->id)
            ->with(['step.template', 'lead.globalNotes.user', 'activityHistory.outcome', 'lead.company.leads'])
            ->whereHas('step', function ($query) use ($campaign) {
                $query->where('type', request()->activity_type)
                ->whereHas('template', function ($q) use ($campaign){
                    $q->where([['campaign_id', $campaign->id], ['account_id', session()->get('user_current_account')]]);
                });
            })
            ->where('current_status', request('lead_stage'))
            ->whereBetween('due_date', [request()->start_date, request()->end_date])
            // ->whereHas('lead', function ($query) {
            //     $query->where('country', 'France');
            // })
            ->get(); //need more leads to check but it works

        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;
        $user = User::with(['userRole'])->find(Auth::id());

        return view('activity-list')->with([
            'leads' => $leads,
            'campaigns' => $campaigns,
            'account' => $account->name,
            'previous_request' => request(),
            'campaign_id' => $campaign->id,
            'user' => $user
        ]);
    }


    public function create()
    {
        ActivityHistory::create([
            'user_id' => Auth::id(),
            'lead_account_id' => request('lead.id'),
            'account_id' => request('lead.account_id'),
            'outcome_id' => request('outcome'),
            'type' => request('lead.step.type'),
            'notes' => request('notes'),
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
    }

    public function email(){
        Mail::to(request('email_address'))
            ->send(new ProspectEmail(request('email_content'), request('email_subject'), request()->file()));
    }
}
