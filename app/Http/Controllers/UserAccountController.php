<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function update(){
        session()->put('user_current_account', (int)request('user_account'));

        return redirect('/');
    }
}
