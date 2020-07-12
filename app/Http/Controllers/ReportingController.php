<?php

namespace App\Http\Controllers;

use App\Account;
use App\Company;
use App\Campaign;
use App\ActivityHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportingController extends Controller
{
    public function index()
    {
        $activityHistories = null;

        if (request()->all()) {
            $activityHistories = ActivityHistory::where('user_id', Auth::user()->id)
                ->where('type', request('activity_type'))
                ->where('account_id', request('account'))
                ->with(['leadAccount'])
                ->whereHas('leadAccount', function ($query) {
                    return $query->where('current_status', request('lead_stage'));
                })
                ->get();
        }

        $accounts = Account::with(['accountCampaigns.campaign'])->get();
        $campaigns = Campaign::get();
        $companies = Company::take(200)->get();

        return view('reporting')->with([
            'results' => $activityHistories,
            'accounts' => $accounts,
            'campaigns' => $campaigns,
            'companies' => $companies
        ]);
    }

    public function show()
    {
        $activityHistories = ActivityHistory::where('user_id', Auth::user()->id)
            ->where('type', request('activity_type'))
            ->where('account_id', request('account'))
            ->with(['leadAccount'])
            ->whereHas('leadAccount', function ($query) {
                return $query->where('current_status', request('lead_stage'));
            })
            ->get();


        return response()->json([
            'activityHistories' => $activityHistories
        ]);
    }
}
