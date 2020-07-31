<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Step;
use App\User;
use App\Account;
use App\Company;
use App\Campaign;
use Carbon\Carbon;
use App\AllFilters;
use App\LeadAccount;
use App\CampaignSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeadAccountController extends Controller
{
    public function index(AllFilters $filters)
    {
        $companies = Company::all();
        $accounts = Account::all();
        $countries = DB::table('countries')->pluck('name');
        $user = User::with(['userAccounts.account.campaigns'])->find(Auth::id());
        $leads = [];
        if (request()->all()) {
            $leads = Lead::with(['leadAccounts.account'])->filter($filters)->get();;
            if (request('excludedAccount')) {
                $newLeads = [];
                foreach ($leads as $item => $value) {
                    if (
                        $value->leadAccounts->every(function ($i, $v) {
                            return $i['account_id'] != request('excludedAccount');
                        })
                        ) {
                            $newLeads[] = $value;
                        };
                    };
                    $leads = $newLeads;
            }
        }

        return view('new-leads.lead-shopping', compact('companies', 'countries', 'user', 'leads', 'accounts'));
    }

    public function show(AllFilters $filters)
    {
        $leads = Lead::with(['leadAccounts.account'])->filter($filters)->get();

        if (request('excludedAccount')) {
            $newLeads = [];
            foreach ($leads as $item => $value) {
                if (
                    $value->leadAccounts->every(function ($i, $v) {
                        return $i['account_id'] !== request('excludedAccount');
                    })
                ) {
                    $newLeads[] = $value;
                };
            };
            $leads = $newLeads;
        }

        return response()->json($leads);
    }


    public function create()
    {
        $scheduleId = 1; //everybody starts from prospecting

        $campaignScheduleId = CampaignSchedule::where([['campaign_id', request('campaign_id')], ['schedule_id', $scheduleId]])->first()->id;

        $stepId = Step::where('campaign_schedule_id', $campaignScheduleId)->first()->id;
        $leadAccounts = [];

        if (request('lead_id') === "all") {
            $leads = Lead::where([['unassigned', 1], ['user_id', Auth::id()]])->with(['company', 'leadAccounts'])->get();

            foreach ($leads as $key => $lead) {
                $leadAccounts[] = [
                    'lead_id' => $lead->id,
                    'account_id' => request('account_id'),
                    'campaign_id' => request('campaign_id'),
                    'schedule_id' => $scheduleId,
                    'step_id' => $stepId,
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
                    'schedule_id' => $scheduleId,
                    'step_id' => $stepId,
                    'current_status' => 'prospecting',
                    'due_date' => Carbon::now()->format('Y-m-d'),
                ];
            }
        } else {
            $leadAccounts[] = [
                'lead_id' => request('lead_id'),
                'account_id' => request('account_id'),
                'campaign_id' => request('campaign_id'),
                'schedule_id' => $scheduleId,
                'step_id' => $stepId,
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
