<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use App\UserRole;
use App\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'user_role_id' => request('role'),
            'password' => Hash::make(request('password')),
        ]);

        UserAccount::create([
            'user_id' => $user->id,
            'account_id' => request('account_id')
        ]);

        Password::broker()->sendResetLink(['email' => $user->email]);

        $this->flashSuccess("{$user->name}'s account created successfully!");

        return redirect()->back();
    }

    public function show()
    {
        $users = User::with(['userRole', 'userAccounts.account'])->get();
        return view('admin.admin-users', compact('users'));
    }

    public function edit($id){
        $user = User::with(['userAccounts', 'userRole'])->find($id);

        return view('admin/admin-user-details', compact('user'));
    }
}
