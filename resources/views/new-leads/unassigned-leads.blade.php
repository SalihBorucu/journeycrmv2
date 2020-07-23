@extends('layouts.main')
@section('content')
@include('layouts.new-lead-bar')
<div id="create-lead-app">
    <unassigned-leads
    :unassigned-leads="{{ json_encode($unassignedLeads) }}"
    :user="{{ json_encode($user) }}">
    </unassigned-leads>
</div>
@endsection
