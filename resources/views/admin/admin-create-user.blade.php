@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.admin-nav-bar')
    <div class="row">
        <div class="card m-b-30 card-body">
            <form class="form-horizontal m-t-20" method="POST" action="/admin/user">
                @csrf
                <div class="form-group row">
                    <div class="col-12">
                        <input class="form-control @error('name') form-control-danger @enderror" name="name" type="name" placeholder="Full Name">
                        @error('name')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <input class="form-control @error('name') form-control-danger @enderror" name="email" placeholder="Email">
                        @error('email')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                </div>

                <div class="d-flex justify-content-around align-items-center mb-2">
                    <label class="col-sm-1">Password: </label>
                    <div>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password">
                        @error('password')
                        <small class="small text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <label class="col-sm-1">Confirm: </label>
                    <div>
                        <input class="form-control" name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password">
                    </div>
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
