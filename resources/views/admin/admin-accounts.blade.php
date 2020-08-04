@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.admin-nav-bar')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Accounts</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($accounts as $account)
        <div class="col-xl-4">
            <div class="card m-b-30 card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title font-16 mt-0">{{ $account->name }}</h4>
                    @if (!$account->complete)
                    <div>
                        <span class="badge badge-warning" disabled>Not Published</span>
                    </div>
                    @endif
                </div>
                <ul>
                    <li><strong>Campaigns:</strong>
                        @foreach ($account->campaigns as $campaign)
                        {{ $campaign->name }},
                        @endforeach
                    </li>
                    <li><strong>Users:</strong>
                        @foreach ($account->userAccounts as $userAccount)
                        {{ $userAccount->user->name }},
                        @endforeach
                    </li>
                </ul>
                <a href="/admin/account/{{ $account->id }}" class="btn btn-primary waves-effect waves-light">Edit Account</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
