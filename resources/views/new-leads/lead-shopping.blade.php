@extends('layouts.main')
@section('content')
@include('layouts.new-lead-bar')

<div id="create-lead-app">
    <lead-shopping
    :companies="{{ json_encode($companies) }}"
    :countries="{{ json_encode($countries) }}">
    </lead-shopping>
</div>
@endsection
