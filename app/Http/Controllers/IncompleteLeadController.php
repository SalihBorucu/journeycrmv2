<?php

namespace App\Http\Controllers;

use App\Company;
use App\IncompleteLead;
use Illuminate\Http\Request;

class IncompleteLeadController extends Controller
{
    public function index(){
        $incompleteLeads = IncompleteLead::all();
        $companies = Company::all();

        return view('new-leads.incomplete-leads', compact('incompleteLeads', 'companies'));
    }

    public function create(){
        // dd(json_decode(request()->getContent(), true));
        return response('done');
        // IncompleteLead::create([
        //         'first_name' => request('first_name'),
        //         'last_name' => request('last_name'),
        //         'company_name' => request('company_name'),
        //         'country' => request('country'),
        //         'title' => request('title'),
        //         'linkedin' => request('linkedin'),
        //         'user_id' => Auth::id(),
        //         'unassigned' => true
        //     ]);
    }

    public function destroy(IncompleteLead $incompleteLead){
        $incompleteLead->delete();
    }
}
