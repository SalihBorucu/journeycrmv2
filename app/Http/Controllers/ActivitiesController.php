<?php

namespace App\Http\Controllers;

use App\Steps;
use App\Account;
use App\Outcome;
use App\Campaign;
use App\Schedule;
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
            ->where('current_status', request('lead_stage'))
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

    public function create(){

        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'lead_account_id' => request('lead.id'),
            'account_id' => request('lead.account_id'),
            'outcome_id' => request('outcome'),
            'type' => request('lead.step.type'),
            'notes' => request('call_notes'),
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);

        $outcome = Outcome::find(request('outcome'));
        $nextSchedule = $outcome->new_schedule_id ? $outcome->new_schedule_id :  request('lead.schedule_id');

        if($outcome->new_schedule_id){
            $nextStep = Steps::where('schedule_id', $outcome->new_schedule_id)
                ->where('step_number', 1)
                ->first();
            $nextDueDate = request('lead.due_date');

            $nextStatus = $outcome->type;
        }else {
            $nextStep = Steps::where('schedule_id', request('lead.schedule_id'))
                ->where('step_number', request('lead.step.step_number') + 1)
                ->first();
                $day_gap = request('lead.step.day_gap');
                $nextDueDate = date('Y-m-d', strtotime(request('lead.due_date') . " +{$day_gap} day"));
                $nextStatus = 'prospecting';
        }

        LeadAccount::find(request('lead.id'))->update([
            'schedule_id' => $nextSchedule,
            'step_id' => $nextStep->id,
            'due_date' => $nextDueDate,
            'current_status' => $nextStatus
        ]);

        return response()->json();
    }
}
