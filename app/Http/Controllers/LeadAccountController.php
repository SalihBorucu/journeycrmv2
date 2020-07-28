<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Steps;
use App\Company;
use App\Campaign;
use Carbon\Carbon;
use App\LeadAccount;
use App\AllFilters;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeadAccountController extends Controller
{
    public function index(AllFilters $filters)
    {
        $companies = Company::all();
        $countries = DB::table('countries')->pluck('name');
        $user = User::with(['userAccounts.account.accountCampaigns.campaign'])->find(Auth::id());
        $leads = [];
        if (request()->all()) {
            $leads = Lead::with(['leadAccounts.account'])->filter($filters)->limit(5000)->get()->toArray();
        }

        return view('new-leads.lead-shopping', compact('companies', 'countries', 'user', 'leads'));
    }

    public function show(AllFilters $filters)
    {
        $leads = Lead::with(['leadAccounts.account'])->filter($filters)->limit(5000)->get()->toArray();

        return response()->json($leads);
    }


    public function create()
    {
        $schedule_id = Campaign::find(request('campaign_id'))->schedule_id;
        $step_id = Steps::where([['schedule_id', $schedule_id], ['step_number', 1]])->first()->id;
        $leadAccounts = [];

        if (request('lead_id') === "all") {
            $leads = Lead::where([['unassigned', 1], ['user_id', Auth::id()]])->with(['company'])->get();

            foreach ($leads as $key => $lead) {
                $leadAccounts[] = [
                    'lead_id' => $lead->id,
                    'account_id' => request('account_id'),
                    'campaign_id' => request('campaign_id'),
                    'schedule_id' => $schedule_id,
                    'step_id' => $step_id,
                    'current_status' => 'prospecting',
                    'due_date' => Carbon::now()->format('Y-m-d'),
                ];

                Lead::find($lead->id)->update([
                    'unassigned' => false
                ]);
            }
        } else if (gettype(request('lead_id')) === "array") {
            foreach (request('lead_id') as $lead => $id) {
                $leadAccounts[] = [
                    'lead_id' => $id,
                    'account_id' => request('account_id'),
                    'campaign_id' => request('campaign_id'),
                    'schedule_id' => $schedule_id,
                    'step_id' => $step_id,
                    'current_status' => 'prospecting',
                    'due_date' => Carbon::now()->format('Y-m-d'),
                ];
            }
        } else {
            $leadAccounts[] = [
                'lead_id' => request('lead_id'),
                'account_id' => request('account_id'),
                'campaign_id' => request('campaign_id'),
                'schedule_id' => $schedule_id,
                'step_id' => $step_id,
                'current_status' => 'prospecting',
                'due_date' => Carbon::now()->format('Y-m-d'),
            ];

            Lead::find(request('lead_id'))->update([
                'unassigned' => false
            ]);
        }

        LeadAccount::insert($leadAccounts);

        return response()->json();
    }
}
