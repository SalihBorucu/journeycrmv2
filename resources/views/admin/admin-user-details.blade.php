@extends('layouts.main')
@section('content')
<div class="container-fluid">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">{{ $user->name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal m-t-20" method="POST" action="/admin/user">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Full Name</label>
                                            <input class="form-control @error('name') form-control-danger @enderror" name="name" type="name" placeholder="Full Name" value="{{ $user->name }}">
                                            @error('name')
                                            <small class="small text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label>Email</label>
                                            <input class="form-control @error('name') form-control-danger @enderror" name="email" placeholder="Email" value="{{ $user->email }}">
                                            @error('email')
                                            <small class="small text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
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
                                    </div> --}}
                                    <div class="form-group text-center row m-t-20">
                                        <div class="col-12">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                                        </div>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
