<?php

namespace App\Http\Controllers;

use App\Company;
use App\IncompleteLead;
use Illuminate\Http\Request;

class IncompleteLeadController extends Controller
{
    public function index()
    {
        $incompleteLeads = IncompleteLead::all();
        $companies = Company::all();

        return view('new-leads.incomplete-leads', compact('incompleteLeads', 'companies'));
    }

    public function create()
    {
        // dd(json_decode(request()->getContent(), true)['first_name']);
        $request = json_decode(request()->getContent(), true);
        dd($request['user_email']);

        IncompleteLead::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_name' => $request['company_name'],
            'country' => $request['country'],
            'title' => $request['title'],
            'linkedin' => $request['linkedin'],
            'user_id' => 1,
            'unassigned' => true
        ]);

        return response('done');
    }

    public function destroy(IncompleteLead $incompleteLead)
    {
        $incompleteLead->delete();
    }
}
