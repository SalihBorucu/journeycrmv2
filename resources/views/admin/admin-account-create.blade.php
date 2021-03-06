@extends('layouts.main')
@section('content')
<div class="container-fluid" id="admin-app">
    @include('layouts.admin-nav-bar')
    <create-account
    :users="{{ json_encode($users) }}"
    :current-user="{{ json_encode($currentUser) }}"
    :schedules="{{ json_encode($schedules) }}"
    ></create-account>
</div>
@endsection
