<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;

class ActivitiesController extends Controller
{
    public function index(){
        $account = Account::find(session()->get('user_current_account'));
        $campaigns = $account->accountCampaigns;

        return view('activities')->with([
            'campaigns' => $campaigns,
            'account' => $account->name
        ]);
    }

    public function fetch(Campaign $campaign){
        dd(request()->all());
        /*
        find me account_leads that have
        X(account id(session)) and
        Y(campaign id) and
        step_type Z (email, phone etc) and
        lead->country XY
        */
        $leads = AccountLead::find();
    }
}
