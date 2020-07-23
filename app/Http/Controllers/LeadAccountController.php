<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Steps;
use App\Company;
use App\Campaign;
use Carbon\Carbon;
use App\LeadAccount;
use Illuminate\Support\Facades\DB;

class LeadAccountController extends Controller
{
    public function index(){
        $companies = Company::all();
        $countries = DB::table('countries')->pluck('name');

        return view('new-leads.lead-shopping', compact('companies', 'countries'));
    }

    public function create()
    {
        $schedule_id = Campaign::find(request('campaign_id'))->schedule_id;
        $step_id = Steps::where([['schedule_id', $schedule_id], ['step_number', 1]])->first()->id;
        $leadAccounts = [];

        if (request('lead_id') === "all") {
            $leads = Lead::where('unassigned', 1)->with(['company'])->get();

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
        } else {
            $leadAccounts[] = [
                'lead_id' => request('lead_id'),
                'account_id' => request('account_id'),
                'campaign_id' => request('campaign_id'),
                'schedule_id' => $schedule_id,
                'step_id' => $step_id,
                'current_status' => 'prospecting',
                'due_date' => Carbon::now()->format('Y-m-d'), //may be add the option to choose later
            ];

            Lead::find(request('lead_id'))->update([
                'unassigned' => false
            ]);
        }

        LeadAccount::insert($leadAccounts);

        return response()->json();
    }
}
