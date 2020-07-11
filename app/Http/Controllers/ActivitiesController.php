<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;
use App\LeadAccount;

class ActivitiesController extends Controller
{
    public function index()
    {
        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;

        return view('activities')->with([
            'campaigns' => $campaigns,
            'account' => $account->name
        ]);
    }

    public function fetch(Campaign $campaign)
    {
        $leads = LeadAccount::where('account_id', session()->get('user_current_account'))
            ->where('campaign_id', $campaign->id)
            ->with(['step', 'lead.globalNotes.user', 'activityHistory', 'lead.company.leads'])
            ->whereHas('step', function ($query) {
                $query->where('type', request()->activity_type);
            })
            // ->whereHas('schedule', function ($query) {
            //     $query->where('id', 2);
            // }) // Hard coded - Todo - accountlead needs a qualified, prospecting etc id
            ->whereBetween('due_date', [request()->start_date, request()->end_date])
            // ->whereHas('lead', function ($query) {
            //     $query->where('country', 'France');
            // })
            //need more leads to check but it works
            ->get();

        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;

        return view('leads')->with([
            'leads' => $leads,
            'campaigns' => $campaigns,
            'account' => $account->name,
            'previous_request' => request(),
            'campaign_id' => $campaign->id
        ]);
    }
}
