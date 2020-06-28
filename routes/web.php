<?php

use App\User;
use App\Account;
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

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

ROute::get('/test', function(){
    dd(User::find(2)->userAccounts[0]->accounts->name);
    // dd(Account::find(3)->users[1]->accountUsers->name);
    // dd(UserAccount::find(1)->accountUsers);
});
