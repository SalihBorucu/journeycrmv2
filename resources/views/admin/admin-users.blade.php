@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.admin-nav-bar')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Users</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        @foreach ($users as $user)
        <div class="col-xl-4">
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">{{ $user->name }}</h4>
                <ul>
                    <li><strong>Role: </strong>{{ $user->userRole->name }}
                    </li>
                    <li><strong>Accounts: </strong>
                        @foreach ($user->userAccounts as $userAccount)
                        {{ $userAccount->account->name }},
                        @endforeach
                    </li>
                </ul>
                <a href="../user/{{ $user->id }}" class="btn btn-primary waves-effect waves-light">Edit User</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
