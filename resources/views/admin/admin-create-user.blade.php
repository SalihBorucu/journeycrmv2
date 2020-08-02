@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.admin-nav-bar')
    <div class="row">
        <div class="card m-b-30 card-body">
            <form action="/admin/user" method="POST">
                @csrf
                <h3 class="card-title font-16 mt-0">Create New User</h3>
                <div class="d-flex justify-content-around align-items-center">
                    <label class="col-sm-1">Name: </label>
                    <input type="text" class="form-control mx-2" name="name" />
                    <label class="col-sm-1">Email: </label>
                    <input type="email" class="form-control mx-2" name="email">
                </div>
                <div class="d-flex justify-content-around align-items-center my-2">
                    <label class="col-sm-1">Password: </label>
                    <input type="password" class="form-control mx-2" name="password">
                    <label class="col-sm-1">Confirm Password: </label>
                    <input type="password" class="form-control mx-2" name="password_confirm">
                </div>
                <div class="d-flex justify-content-around align-items-center mb-2">
                    <label class="col-sm-1">Role: </label>
                    <select name="role" class="form-control mx-2">
                        @foreach ($userRoles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <label class="col-sm-1">Account: </label>
                    <select name="account_id" class="form-control mx-2">
                        @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Create New Lead</button>
            </form>
        </div>
    </div>
</div>
@endsection
