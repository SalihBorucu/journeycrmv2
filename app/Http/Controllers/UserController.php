<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use App\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'user_role_id' => request('role'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect();
    }

    public function show()
    {
        $users = User::with(['userRole', 'userAccounts.account'])->get();
        return view('admin.admin-user', compact('users'));
    }
}
