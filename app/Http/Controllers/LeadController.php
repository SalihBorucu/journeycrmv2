<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('new-lead', compact('companies', 'countries', 'leadEmails'));
    }

    public function create()
    {
        // dd(request()->all());
        $companyId = request('company');
        if(gettype(request('company')) === "string"){
            $company = Company::create([
                'name' => request('company'),
                'tools_note' => 'sthing'
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
            'linkedin' => request('linkedin')
        ]);

        return response()->json(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
