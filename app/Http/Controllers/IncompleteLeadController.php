<?php

namespace App\Http\Controllers;

use App\IncompleteLead;
use Illuminate\Http\Request;

class IncompleteLeadController extends Controller
{
    public function index(){
        $incompleteLeads = IncompleteLead::all();
        return view('new-leads.incomplete-leads', compact('incompleteLeads'));
    }
}
