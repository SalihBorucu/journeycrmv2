<?php

namespace App\Http\Controllers;

use App\Account;
// use App\Company;
use App\Campaign;
use App\ActivityHistory;
use App\AllFilters;

class ReportingController extends Controller
{
    public function index(AllFilters $filters)
    {
        $activityHistories = [];
        if (request()->all()) {
            $activityHistories = ActivityHistory::with('user', 'leadAccount', 'account', 'outcome')
            ->whereBetween('created_at', [request('start_date'), request('end_date')])
            ->filter($filters)->get();
        }

        $accounts = Account::with(['campaigns'])->get();
        $campaigns = Campaign::get();
        // $companies = Company::take(200)->get(); //might need later

        return view('reporting')->with([
            'results' => array_values($this->convertActivityHistories($activityHistories, request('reportType'))),
            'accounts' => $accounts,
            'campaigns' => $campaigns,
            // 'companies' => $companies
        ]);
    }

    public function show(AllFilters $filters)
    {
        $activityHistories = ActivityHistory::with('user', 'leadAccount', 'account', 'outcome')
            ->whereBetween('created_at', [request('start_date'), request('end_date')])
            ->filter($filters)->get();

        return response()->json([
            'activitiesByUser' => array_values($this->convertActivityHistories($activityHistories, request('reportType')))
        ]);
    }

    protected function convertActivityHistories($activityHistories, $reportType)
    {
        $xAxis = strpos($reportType, 'ser') ? 'user' : 'account';
        $results = [];

        foreach ($activityHistories as $key => $value) {
            if (strpos($reportType, 'Results')) {
                $results[$value->$xAxis->name][$value->outcome->name] = $value->cnt;
                $results[$value->$xAxis->name]['type'] = $value->$xAxis->name;
            } else {
                $results[$value->$xAxis->name][$value->type] = $value->cnt;
                $results[$value->$xAxis->name]['type'] = $value->$xAxis->name;
            }
        }

        return $results;
    }
}
