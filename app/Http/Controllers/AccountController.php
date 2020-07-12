<?php

namespace App\Http\Controllers;

use App\Account;
use App\Lead;
use App\LeadAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $currentAccount = Account::find(session()->get('user_current_account'));

        $companies = array_unique(LeadAccount::where('account_id', $currentAccount->id)
            ->with(['lead.company'])
            ->get()
            ->pluck('lead.company.name')
            ->toArray());

        $leads = null;
        if(request('company')){
            $leads = request('company');
        };

        return view('accounts')->with([
            'account' => $currentAccount,
            'companies' => $companies,
            'leads' => $leads
        ]);
    }
}
