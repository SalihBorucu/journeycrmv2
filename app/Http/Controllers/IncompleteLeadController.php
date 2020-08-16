<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Company;
use App\IncompleteLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncompleteLeadController extends Controller
{
    public function index()
    {
        $incompleteLeads = IncompleteLead::where('user_id', Auth::id())->get();
        $companies = Company::all();
        $leadEmails = Lead::all()->pluck('email');
        $countries = DB::table('countries')->pluck('name');

        return view('new-leads.incomplete-leads', compact('incompleteLeads', 'companies', 'leadEmails', 'countries'));
    }

    public function create(Request $request)
    {
        $request = json_decode(request()->getContent(), true);

            IncompleteLead::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'company_name' => $request['company_name'],
                'country' => $request['country'],
                'title' => $request['title'],
                'linkedin' => $request['linkedin'],
                'user_id' => Auth::id(),
                'unassigned' => true
            ]);

            return response('done');
    }

    public function destroy(IncompleteLead $incompleteLead)
    {
        $incompleteLead->delete();
    }
}
