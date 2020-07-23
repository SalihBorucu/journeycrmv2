<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Steps;
use App\Campaign;
use Carbon\Carbon;
use App\LeadAccount;
use Illuminate\Http\Request;

class LeadAccountController extends Controller
{
    public function create(){
        $schedule_id = Campaign::find(request('campaign_id'))->schedule_id;
        $step_id = Steps::where([['schedule_id', $schedule_id], ['step_number', 1]])->first()->id;

        Lead::find(request('lead_id'))->update([
            'unassigned' => false
        ]);

        LeadAccount::create([
            'lead_id' => request('lead_id'),
            'account_id' => request('account_id'),
            'campaign_id' => request('campaign_id'),
            'schedule_id' => $schedule_id,
            'step_id' => $step_id,
            'current_status' => 'prospecting',
            'due_date' => Carbon::now()->format('Y-m-d'), //may be add the option to choose later
        ]);

        return response()->json(request()->all());
    }
}
