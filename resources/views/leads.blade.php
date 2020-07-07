@extends('layouts.main')
@section('content')

<div id="app">
    <div class="sidebar card">
        <form action="/activities/campaign/{{ $campaign_id }}" method="GET">
            {{-- <h4 class="card-title font-16 mt-0">{{ $campaign->campaign->name }}</h4>
            <p class="card-text"> {{ $campaign->campaign->definition }}</p> --}}
            <div class="">
                <div class="m-2">
                    <label for="">Activity Type</label>
                    <select class="form-control" name="activity_type">
                        <option value="email" {{ $previous_request->activity_type === 'email' ? 'selected' : '' }}>Email</option>
                        <option value="social" {{ $previous_request->activity_type === 'social' ? 'selected' : '' }} >Social</option>
                        <option value="call" {{ $previous_request->activity_type === 'call' ? 'selected' : '' }}>Phone</option>
                    </select>
                </div>
                <div class="m-2">
                    <label for="">Lead Stage</label>
                    <select class="form-control" name="lead_stage">
                        <option value="prospecting" {{ $previous_request->lead_stage === 'prospecting' ? 'selected' : '' }}>Prospecting</option>
                        <option value="interested" {{ $previous_request->lead_stage === 'interested' ? 'selected' : '' }}>Interested</option>
                        <option value="qualified" {{ $previous_request->lead_stage === 'qualified' ? 'selected' : '' }}>Qualified</option>
                    </select>
                </div>

                <div class="m-2">
                    <label for="">Country</label>
                    <select class="form-control" name="country">
                        <option value="united_kingdom">United Kingdom</option>
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <div class="m-2">
                    <label for="example-date-input">Starting Date</label>
                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $previous_request->start_date }}">
                </div>

                <div class="m-2">
                    <label for="example-date-input">End Date</label>
                    <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $previous_request->end_date }}">
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light w-100 mt-3">Adjust Search</button>
            </div>
        </form>
    </div>

    <leads-list-main :leads='{{ json_encode($leads) }}'></leads-list-main>
</div>
@endsection

<style>
    .sidebar {
        z-index: 30;
        position: absolute !important;
        top: 61px;
        left: 0;
        width: 15vw;
        height: 90vh;
    }
</style>
