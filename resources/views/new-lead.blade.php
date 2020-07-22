@extends('layouts.main')
@section('content')
<div id="create-lead-app">
    <create-lead
    :lead-emails = "{{ json_encode($leadEmails) }}"
    :countries = "{{ json_encode($countries) }}"
    :companies = "{{ json_encode($companies) }}"></create-lead>
</div>
@endsection
