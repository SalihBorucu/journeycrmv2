<?php

use App\Account;
use App\Step;
use App\Campaign;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GlobalLeadNotesController;
use App\Http\Middleware\CheckPermission;
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

    Route::get('/extension', function () {
        return view('extension');
    });

    Route::get('/activities', 'ActivitiesController@index');
    Route::get('/activities/campaign/{campaign}', 'ActivitiesController@show');
    Route::post('/activity', 'ActivitiesController@create');
    Route::post('/activity/email', 'ActivitiesController@email');

    Route::post('/global-note', 'GlobalLeadNotesController@create');
    Route::patch('/company/{id}', 'CompanyController@update');

    Route::get('/lead', 'LeadController@index');
    Route::post('/lead', 'LeadController@create');
    Route::patch('/lead/{id}', 'LeadController@update');
    Route::get('/lead/unassigned-leads', 'LeadController@show');

    Route::get('/lead/lead-shopping', 'LeadAccountController@index');
    Route::post('/lead/lead-shopping', 'LeadAccountController@show');

    //Admin routes
    Route::middleware([CheckPermission::class])->prefix('admin')->group(function () {
        Route::get('/settings', function () {
            return view('settings');
        });
        Route::post('/account', 'AccountController@create');
        Route::get('/account', 'AccountController@index');
        Route::get('/account/{id}', 'AccountController@show');
        Route::patch('/account/{id}', 'AccountController@update');
        Route::patch('/account/publish/{id}', 'AccountController@publish');
        Route::patch('/campaign/{id}', 'CampaignController@update');
        Route::post('/campaign', 'CampaignController@create');
        Route::delete('/campaign/{id}', 'CampaignController@destroy');
        Route::patch('/schedule/{id}', 'StepController@update');
        Route::patch('/template/{id}', 'StepTemplateController@update');
        Route::post('/template', 'StepTemplateController@create');

        Route::get('/user/create', 'UserController@index');
        Route::post('/user', 'UserController@create');
        Route::get('/user', 'UserController@show');

        Route::get('', function () {
            $campaigns = Campaign::all();
            $schedules = Schedule::where('type', 'standard')->get();
            $users = User::all();
            $currentUser = Auth::user();

            return view('admin.admin-account-create', compact('campaigns', 'schedules', 'users', 'currentUser'));
        });
    });

    Route::get('user/{id}', 'UserController@edit');

    Route::get('/lead/incomplete-leads', 'IncompleteLeadController@index');
    Route::delete('/incomplete-leads/{incompleteLead}', 'IncompleteLeadController@destroy');


    Route::post('/lead-account', 'LeadAccountController@create');

    Route::get('/reporting', 'ReportingController@index');
    Route::post('/reporting', 'ReportingController@show');

    Route::post('/useraccount', 'UserAccountController@update');
});


//Twilio Routes
Route::post('/token', 'CallController@newToken');
Route::get('/answer', 'CallController@newCall');


//Test Route
Route::get('/test', function () {
    $user = User::with(['userAccounts.account'])->find(Auth::id());
    $userAccounts = Auth::user()->userAccounts->filter(function ($userAccount) {
        return $userAccount->account->complete === 1;
    });
    dd($userAccounts);
});
