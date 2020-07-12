<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;
use App\Company;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function index(){
        $accounts = Account::with(['accountCampaigns.campaign'])->get();
        $campaigns = Campaign::get();
        $companies = Company::take(200)->get();

        return view('reporting')->with([
            'accounts' => $accounts,
            'campaigns' => $campaigns,
            'companies' => $companies
        ]);
    }

    public function show(){
        dd(request()->all());
    }
}
