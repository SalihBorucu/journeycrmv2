<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\LeadAccount;
use App\Schedule;
use Illuminate\Http\Request;

class LeadAccountController extends Controller
{
    public function create(){
        $schedule_id = Campaign::find(request('campaign_id'))->schedule_id;
        $step_id = Steps::where([['schedule_id', $schedule_id], ['step']])->


        LeadAccount::create([
            'lead_id' => request('lead_id'),
            'account_id' => request('account_id'),
            'campaign_id' => request('campaign_id'),
            'schedule_id' => $schedule_id,

        ]);

        return response()->json(request()->all());
    }
}
