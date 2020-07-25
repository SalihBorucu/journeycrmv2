<?php

use App\User;
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

    Route::get('/activities', 'ActivitiesController@index');
    Route::get('/activities/campaign/{campaign}', 'ActivitiesController@show');
    Route::post('/activity', 'ActivitiesController@create');

    Route::get('/accounts', 'AccountController@index');

    Route::get('/lead', 'LeadController@index');
    Route::post('/lead', 'LeadController@create');
    Route::get('/lead/unassigned-leads', 'LeadController@show');
    Route::get('/lead/lead-shopping', 'LeadAccountController@index');

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
