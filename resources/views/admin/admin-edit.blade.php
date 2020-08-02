@extends('layouts.main')
@section('content')
<div class="container-fluid" id="admin-app">
    @include('layouts.admin-nav-bar')
    <edit-account
    :account="{{ json_encode($account) }}"
    :users="{{ json_encode($users) }}"
    :schedules="{{ json_encode($schedules) }}"
    ></edit-account>
</div>
@endsection
