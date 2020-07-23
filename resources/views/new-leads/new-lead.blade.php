@extends('layouts.main')
@section('content')
@include('layouts.new-lead-bar')
<div id="create-lead-app">
    <create-lead
    :lead-emails = "{{ json_encode($leadEmails) }}"
    :countries = "{{ json_encode($countries) }}"
    :companies = "{{ json_encode($companies) }}"></create-lead>
</div>
@endsection
