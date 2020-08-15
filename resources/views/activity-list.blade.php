@extends('layouts.main')
@section('content')

<div id="activity-app" class="mx-5">
    <leads-list-main
    :user='{{ json_encode($user) }}'
    :leads='{{ json_encode($leads) }}'
    :previous_request='{{ json_encode($previous_request->all()) }}'
    :campaign_id='{{ json_encode($campaign_id) }}'>
    </leads-list-main>
</div>
@endsection

