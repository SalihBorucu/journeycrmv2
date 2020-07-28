<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//for extension API token creation
Route::get('/login-iframe', function () {
    $user = Auth::user();
    if (!$user) {
        return view('iframe')->with(['user' => null]);
    } else {
        $token = $user->createToken('extension'. $user->id)->accessToken;

        return view('iframe')->with([
            'user' => $user,
            'access_token' => $token,
        ]);
    }
});

Route::middleware('auth')->group(function () {
    // Route::get('/summary', function () {
    //     $campaigns = Account::find(Session::get('user_current_account'))->accountCampaigns;
    //     $leads = Account::find(Session::get('user_current_account'))->accountLeads;
    //     // $steps = Lead::find(1)->leadAccounts[0]->account->accountCampaigns[0]->campaign->schedule->steps;
    //     return view('summary')->with([
    //         'campaigns' => $campaigns,
    //         'leads' => $leads,
    //         // 'steps' => $steps
    //     ]);
    // });

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/activities', 'ActivitiesController@index');
    Route::get('/activities/campaign/{campaign}', 'ActivitiesController@show');
    Route::post('/activity', 'ActivitiesController@create');

    Route::get('/accounts', 'AccountController@index');

    Route::get('/lead', 'LeadController@index');
    Route::post('/lead', 'LeadController@create');
    Route::get('/lead/unassigned-leads', 'LeadController@show');

    Route::get('/lead/lead-shopping', 'LeadAccountController@index');
    Route::post('/lead/lead-shopping', 'LeadAccountController@show');


    Route::get('/lead/incomplete-leads', 'IncompleteLeadController@index');
    Route::delete('/incomplete-leads/{incompleteLead}', 'IncompleteLeadController@destroy');


    Route::post('/lead-account', 'LeadAccountController@create');

    Route::get('/reporting', 'ReportingController@index');
    Route::post('/reporting', 'ReportingController@show');
    // Route::get('/reporting/results', 'ReportingController@show');


    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/useraccount', 'UserAccountController@update');

});
        Route::get('/test', function () {
            if (Auth::attempt(['email' => 'salih@hotmail1.com', 'password' => '12345678'])) {
                dd('hello');
            }
        });
