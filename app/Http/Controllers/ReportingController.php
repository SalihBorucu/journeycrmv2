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
        $activitiesByUser = [];

        if (request()->all()) {
            $query = ActivityHistory::with('user', 'leadAccount', 'account')->whereBetween('created_at', [request('start_date'), request('end_date')]);
            //user activities
            if (request('report_type') === 'activitiesUser') {
                $query->selectRaw('count(*) AS cnt, user_id, type')->groupBy('user_id', 'type');
                $reportType = 'user';
            }
            //account activities
            if (request('report_type') === 'activitiesAccount') {
                $query->selectRaw('count(*) AS cnt,  account_id, type')->groupBy('account_id', 'type');
                $reportType = 'account';
            }

            //account results
            if (request('report_type') === 'resultsAccount') {
                $query->selectRaw('count(*) AS cnt,  account_id')->groupBy('account_id');
                $reportType = 'account';
            }

            if (request('account')) {
                $query->where('account_id', request('account'));
            }

            if (request('campaign')) {
                $query->whereHas('leadAccount', function ($query) {
                    return $query->where('campaign_id', request('campaign'));
                });
            }

            $activityHistories = $query->get();

            $activitiesByUser = [];
            foreach ($activityHistories as $key => $value) {
                $activitiesByUser[$value->$reportType->name] = null; //change user and account
            };

            foreach ($activityHistories as $key => $value) {
                foreach ($activitiesByUser as $name => $x) {
                    if ($value->$reportType->name === $name) { // change user and account
                        $activitiesByUser[$name][$value->type] = $value->cnt;
                    };
                }
            };

            foreach ($activitiesByUser as $key => $value) {
                $activitiesByUser[$key]['type'] = $key;
            }
        }

        $accounts = Account::with(['accountCampaigns.campaign'])->get();
        $campaigns = Campaign::get();
        $companies = Company::take(200)->get();
        return view('reporting')->with([
            'results' => array_values($activitiesByUser),
            'accounts' => $accounts,
            'campaigns' => $campaigns,
            'companies' => $companies
        ]);
    }

    public function show()
    {
        $query = ActivityHistory::with('user', 'leadAccount', 'account', 'outcome')->whereBetween('created_at', [request('start_date'), request('end_date')]);
        //user activities
        if (request('report_type') === 'activitiesUser') {
            $query->selectRaw('count(*) AS cnt, user_id, type')->groupBy('user_id', 'type');
            $reportType = 'user';
            $reportY = 'type';
        }
        //account activities
        if (request('report_type') === 'activitiesAccount') {
            $query->selectRaw('count(*) AS cnt, account_id, type')->groupBy('account_id', 'type');
            $reportType = 'account';
            $reportY = 'type';
        }

        //account results
        if (request('report_type') === 'resultsAccount') {
            $query->selectRaw('count(*) AS cnt, account_id, outcome_id')->groupBy('account_id', 'outcome_id');
            $reportType = 'account';
            $reportY = 'outcome';
        }

        if (request('account')) {
            $query->where('account_id', request('account'));
        }

        if (request('campaign')) {
            $query->whereHas('leadAccount', function ($query) {
                return $query->where('campaign_id', request('campaign'));
            });
        }

        $activityHistories = $query->get();

        $activitiesByUser = [];
        foreach ($activityHistories as $key => $value) {
            $activitiesByUser[$value->$reportType->name] = null;
        };

        foreach ($activityHistories as $key => $value) {
            foreach ($activitiesByUser as $name => $x) {
                if ($value->$reportType->name === $name) {
                    if ($reportY === 'outcome') {
                        $activitiesByUser[$name][$value->$reportY->name] = $value->cnt; // this part is too manual
                    } else{
                        $activitiesByUser[$name][$value->$reportY] = $value->cnt;
                    }
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
