@extends('layouts.main')
@section('content')

<div id="create-lead-app">
    @include('layouts.new-lead-bar')
    <lead-shopping
    :companies="{{ json_encode($companies) }}"
    :countries="{{ json_encode($countries) }}"
    :user="{{ json_encode($user) }}"
    :inj-leads = "{{ json_encode($leads) }}"
    :accounts= "{{ json_encode($accounts) }}"
    >
    </lead-shopping>
</div>
@endsection
