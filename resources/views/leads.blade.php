@extends('layouts.main')
@section('content')

<div id="app">
    <leads-list-main
    :leads='{{ json_encode($leads) }}'
    :previous_request='{{ json_encode($previous_request->all()) }}'
    :campaign_id='{{ json_encode($campaign_id) }}'>
    </leads-list-main>
</div>
@endsection

<style>

</style>
