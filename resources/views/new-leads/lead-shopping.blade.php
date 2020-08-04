@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.new-lead-bar')
</div>
<div id="create-lead-app" class="mx-5">
    <lead-shopping
    :companies="{{ json_encode($companies) }}"
    :countries="{{ json_encode($countries) }}"
    :user="{{ json_encode($user) }}"
    :inj-leads="{{ json_encode($leads) }}"
    :accounts="{{ json_encode($accounts) }}">
    </lead-shopping>
</div>
@endsection
