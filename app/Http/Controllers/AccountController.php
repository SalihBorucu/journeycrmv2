<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountCampaign;
use App\Campaign;
use App\Lead;
use App\LeadAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function create(){
        $account = Account::create([
            'name' => request('account_name')
        ]);


        $this->flashSuccess("Account created successfully");

        return redirect()->back();
    }
}
