<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $leadEmails = Lead::pluck('email')->toArray();
        $countries = DB::table('countries')->pluck('name')->toArray();

        return view('new-leads.new-lead', compact('companies', 'countries', 'leadEmails'));
    }

    public function create()
    {
        $companyId = request('company');
        if(gettype(request('company')) === "string"){
            $company = Company::create([
                'name' => request('company'),
            ]);

            $companyId = $company->id;
        };

        Lead::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'company_id' => $companyId,
            'email' => request('email'),
            'title' => request('title'),
            'phone_1' => request('phone_1'),
            'phone_2' => request('phone_2'),
            'country' => request('country'),
            'linkedin' => request('linkedin'),
            'user_id' => Auth::user()->id,
            'unassigned' => true,
        ]);

        return response()->json(request()->all());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Lead $lead)
    {
        $unassignedLeads = $lead->where([['unassigned', 1], ['user_id', Auth::id()]])->with(['company'])->get();
        $user = User::with(['userAccounts.account.campaigns'])->find(Auth::id());

        return view('new-leads.unassigned-leads', compact('unassignedLeads', 'user'));
    }

    public function edit(Lead $lead)
    {
        //
    }

    public function update(Request $request, Lead $lead)
    {
        //
    }

    public function destroy(Lead $lead)
    {
        //
    }
}
