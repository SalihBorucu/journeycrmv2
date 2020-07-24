@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @include('layouts.new-lead-bar')
</div>
<div id="create-lead-app">
    <incomplete-leads
    :companies="{{  json_encode($companies) }}"
    :leads="{{ json_encode($incompleteLeads) }}"
    :user="{{ json_encode(Auth::user()) }}"></incomplete-leads>
</div>
@endsection
