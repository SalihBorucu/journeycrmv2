<?php

use App\Lead;
use App\User;
use App\Account;
use App\Company;
use App\Schedule;
use App\UserRole;
use App\UserAccount;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/summary', function () {
        $campaigns = Account::find(Session::get('user_current_account'))->accountCampaigns;
        $leads = Account::find(Session::get('user_current_account'))->accountLeads;
        // $steps = Lead::find(1)->leadAccounts[0]->account->accountCampaigns[0]->campaign->schedule->steps;
        return view('welcome')->with([
            'campaigns' => $campaigns,
            'leads' => $leads,
            // 'steps' => $steps
        ]);
    });

    Route::get('/', function() {
        return view('dashboard');
    });

    Route::get('/activities', 'ActivitiesController@index');
    Route::get('/activities/campaign/{campaign}', 'ActivitiesController@fetch');
    Route::post('/activity', 'ActivitiesController@create');

    Route::get('/accounts', 'AccountController@index');

    Route::get('/reporting', 'ReportingController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/useraccount', 'UserAccountController@update');

    Route::get('/test', function(){
        dd(Auth::user()->activityHistories);
    });
});
