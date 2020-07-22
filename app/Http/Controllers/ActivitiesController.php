<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;
use Carbon\Carbon;
use App\LeadAccount;
use App\ActivityHistory;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
{
    public function index()
    {
        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;

        return view('campaigns')->with([
            'campaigns' => $campaigns,
            'account' => $account->name
        ]);
    }

    public function show(Campaign $campaign)
    {
        $leads = LeadAccount::where('account_id', session()->get('user_current_account'))
            ->where('campaign_id', $campaign->id)
            ->with(['step', 'lead.globalNotes.user', 'activityHistory.outcome', 'lead.company.leads'])
            ->whereHas('step', function ($query) {
                $query->where('type', request()->activity_type);
            })
            ->where('current_status', request('lead_stage'))
            ->whereBetween('due_date', [request()->start_date, request()->end_date])
            // ->whereHas('lead', function ($query) {
            //     $query->where('country', 'France');
            // })
            ->get(); //need more leads to check but it works

        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;

        return view('activity-list')->with([
            'leads' => $leads,
            'campaigns' => $campaigns,
            'account' => $account->name,
            'previous_request' => request(),
            'campaign_id' => $campaign->id
        ]);
    }


    public function create()
    {
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'lead_account_id' => request('lead.id'),
            'account_id' => request('lead.account_id'),
            'outcome_id' => request('outcome'),
            'type' => request('lead.step.type'),
            'notes' => request('notes'),
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
    }
}
