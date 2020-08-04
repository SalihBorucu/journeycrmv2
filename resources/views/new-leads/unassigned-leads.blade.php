@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.new-lead-bar')
</div>
<div id="create-lead-app" class="mx-5">
    <unassigned-leads
    :unassigned-leads="{{ json_encode($unassignedLeads) }}"
    :user="{{ json_encode($user) }}"
    :user-accounts="{{ json_encode($userAccounts) }}">
    </unassigned-leads>
</div>
@endsection
