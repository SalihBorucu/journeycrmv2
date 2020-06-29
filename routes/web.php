<?php

use App\Lead;
use App\User;
use App\Account;
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

Route::get('/', function () {
    // dd(Auth::user()->userRole);
    // dd(UserRole::find(1)->user);
    $campaigns = Account::find(Session::get('user_current_account'))->accountCampaigns;
    $leads = Lead::take(5)->get();
    return view('welcome')->with([
        'campaigns' => $campaigns,
        'leads' => $leads
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/useraccount', 'UserAccountController@update');

Route::get('/test', function(){
    // dd(User::find(2)->userAccounts[0]->accounts->name);
    // dd(Account::find(3)->users[1]->accountUsers->name);
    // dd(UserAccount::find(1)->accountUsers);
    // Session::put('id', 1);
    // dd(Account::find(1)->accountLeads[0]->lead);
    dd(Lead::find(1)->leadAccounts[0]->account);
    // dd(Account::find(Session::get('user_current_account'))->accountCampaigns[0]->campaigns->schedule->steps);
    // dd(Schedule::find(1)->steps);
});
