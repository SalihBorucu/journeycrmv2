<?php

use App\Account;
use App\Step;
use App\Campaign;
use App\Schedule;
use App\StepTemplate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//for extension API token creation
Route::get('/login-iframe', function () {
    $user = Auth::user();
    if (!$user) {
        return view('iframe')->with(['user' => null]);
    } else {
        $token = $user->createToken('extension' . $user->id)->accessToken;

        return view('iframe')->with([
            'user' => $user,
            'access_token' => $token,
        ]);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/admin', function () {
        $campaigns = Campaign::all();
        $schedules = Schedule::where('type', 'standard')->get();
        $users = User::all();
        $currentUser = Auth::user();

        return view('admin.admin-account-create', compact('campaigns', 'schedules', 'users', 'currentUser'));
    });

    Route::get('/activities', 'ActivitiesController@index');
    Route::get('/activities/campaign/{campaign}', 'ActivitiesController@show');
    Route::post('/activity', 'ActivitiesController@create');
    Route::post('/activity/email', 'ActivitiesController@email');

    Route::get('/lead', 'LeadController@index');
    Route::post('/lead', 'LeadController@create');
    Route::get('/lead/unassigned-leads', 'LeadController@show');

    Route::get('/lead/lead-shopping', 'LeadAccountController@index');
    Route::post('/lead/lead-shopping', 'LeadAccountController@show');


    Route::post('admin/account', 'AccountController@create');
    Route::get('admin/account', 'AccountController@index');
    Route::get('admin/account/{id}', 'AccountController@show');

    Route::get('/lead/incomplete-leads', 'IncompleteLeadController@index');
    Route::delete('/incomplete-leads/{incompleteLead}', 'IncompleteLeadController@destroy');


    Route::post('/lead-account', 'LeadAccountController@create');

    Route::get('/reporting', 'ReportingController@index');
    Route::post('/reporting', 'ReportingController@show');


    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/useraccount', 'UserAccountController@update');
});


//Twilio Routes
Route::post('/token', 'CallController@newToken');
Route::get('/answer', 'CallController@newCall');

Route::get('/test', function () {
    dd(Account::with('userAccounts.user')->find(1));
});
