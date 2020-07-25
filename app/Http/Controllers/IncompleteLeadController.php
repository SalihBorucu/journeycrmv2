<?php

namespace App\Http\Controllers;

use App\Company;
use App\IncompleteLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request = json_decode(request()->getContent(), true);

        if (Auth::attempt(['email' => $request['userEmail'], 'password' => $request['userPassword']])) {
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

        return response('Wrong login data.');
    }

    public function destroy(IncompleteLead $incompleteLead)
    {
        $incompleteLead->delete();
    }
}
