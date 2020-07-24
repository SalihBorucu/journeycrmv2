@extends('layouts.main')
@section('content')

<div id="create-lead-app">
    @include('layouts.new-lead-bar')
    <lead-shopping
    :companies="{{ json_encode($companies) }}"
    :countries="{{ json_encode($countries) }}">
    </lead-shopping>
</div>
@endsection
