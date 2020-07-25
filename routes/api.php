<?php

use Illuminate\Http\Request;
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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/incomplete-leads', 'IncompleteLeadController@create');
Route::post('/login', function(){
    $request = json_decode(request()->getContent(), true);

    if (Auth::attempt(['email' => $request['userEmail'], 'password' => $request['userPassword']])) {
        return response('done');
    }

    return response()->json('No user with these credentials.');


});
