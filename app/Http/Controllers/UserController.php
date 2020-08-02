<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $userRoles = UserRole::get();
        $accounts = Account::get();
        return view('admin.admin-create-user', compact('userRoles', 'accounts'));
    }

    public function create()
    {
        User::create([

        ]);
    }

    public function show()
    {
        $users = User::with(['userRole', 'userAccounts.account'])->get();
        return view('admin.admin-user', compact('users'));
    }
}
