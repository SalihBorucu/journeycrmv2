<?php

namespace App\Http\Controllers;

use App\ActivityHistory;
use Illuminate\Http\Request;

class ActivityHistoryController extends Controller
{
    public function create(){
        dd(request());
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
