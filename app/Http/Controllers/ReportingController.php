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
        $query = ActivityHistory::with('user', 'leadAccount')->whereBetween('created_at', [request('start_date'), request('end_date')]);

        if(request('report_type') === 'activitiesUser'){
            $query->selectRaw('count(*) AS cnt, user_id, type')->groupBy('user_id', 'type');
        }

        // if(request('report_type') === 'activitiesAccount'){
        //     $query->selectRaw('count(*) AS cnt,  account_id')->groupBy('account_id');
        // } WORKING ON ACTIVITIES BY ACCOUNT

        if (request('account') !== "null") {
            $query->where('account_id', request('account'));
        }

        if (request('campaign') !== "null") {
            $query->whereHas('leadAccount', function ($query) {
                return $query->where('campaign_id', request('campaign'));
            });
        }

        $activityHistories = $query->limit(5)->get();

        // dd($activityHistories);

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


        return response()->json([
            'activitiesByUser' => array_values($activitiesByUser)
        ]);
    }
}
