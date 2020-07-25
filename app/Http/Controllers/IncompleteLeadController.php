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

    public function destroy(IncompleteLead $incompleteLead){
        $incompleteLead->delete();
    }
}
