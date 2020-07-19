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
        //user activities
        $activityHistories = ActivityHistory::with('user')
            ->selectRaw('count(*) AS cnt, user_id, type')
            ->where('account_id', request('account'))
            ->groupBy('user_id', 'type')
            ->get();

        $activitiesByUser = [];
        foreach ($activityHistories as $key => $value) {
            $activitiesByUser[$value->user->name] = null;
        };

        foreach ($activityHistories as $key => $value) {
            foreach ($activitiesByUser as $name => $x) {
                if ($value->user->name === $name) {
                    $activitiesByUser[$name][$value->type] = $value->cnt;
                };
            }
        };

        foreach ($activitiesByUser as $key => $value) {
            $activitiesByUser[$key]['type'] = $key;
        }

        // dd();

        return response()->json([
            'activitiesByUser' => array_values($activitiesByUser)
        ]);
    }
}
