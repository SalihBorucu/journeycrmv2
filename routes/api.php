<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'auth:api'
], function () {

    Route::post('/incomplete-leads', 'IncompleteLeadController@create');

    Route::get('/login-iframe', function(){
        //for already existing tokens
        return 'done';
    });
});

