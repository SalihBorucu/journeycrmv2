@extends('layouts.main')
@section('content')
<div class="container-fluid" id="admin-app">
    <edit-user :user="{{ json_encode($user) }}"></edit-user>
</div>
@endsection
