@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.admin-nav-bar')
    <div class="row">
        <div class="card m-b-30 card-body">
            <form class="form-horizontal m-t-20" method="POST" action="/admin/user">
                @csrf
                <div class="form-group row">
                    <div class="col-6">
                        <label>Full Name </label>
                        <input class="form-control @error('name') form-control-danger @enderror" name="name" type="name" placeholder="Full Name">
                        @error('name')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>Email</label>
                        <input class="form-control @error('name') form-control-danger @enderror" name="email" placeholder="Email">
                        @error('email')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Password </label>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password">
                        @error('password')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>Confirm Password</label>
                        <input class="form-control" name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            @foreach ($userRoles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>First Account</label>
                        <select name="account_id" class="form-control">
                            @foreach ($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group text-center row m-t-20">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
