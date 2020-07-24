@extends('layouts.main')
@section('content')
<div id="create-lead-app" class="container-fluid">
    @include('layouts.new-lead-bar')
    <unassigned-leads
    :unassigned-leads="{{ json_encode($unassignedLeads) }}"
    :user="{{ json_encode($user) }}">
    </unassigned-leads>
</div>
@endsection
