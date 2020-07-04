@extends('layouts.main')
@section('content')
<h4 class="page-title mb-2">{{ $account }}'s Campaigns</h4>
@foreach ($campaigns as $campaign)
<div class="row">
    <div class="w-100">
        <div class="card m-b-30 card-body">
            <form action="/activities/campaign/{{ $campaign->campaign_id }}" method="GET">
                @csrf
                <h4 class="card-title font-16 mt-0">{{ $campaign->campaign->name }}</h4>
                <p class="card-text"> {{ $campaign->campaign->definition }}</p>
                <div class="d-flex justify-content-around mb-2">
                    <div class="w-100 mx-2">
                        <label for="">Activity Type</label>
                        <select class="form-control" name="activity_type" id="">
                            <option value="email">Email</option>
                            <option value="social">Social</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                    <div class="w-100 mx-2">
                        <label for="">Lead Stage</label>
                        <select class="form-control" name="lead_stage" id="">
                            <option value="prospecting">Prospecting</option>
                            <option value="interested">Interested</option>
                            <option value="qualified">Qualified</option>
                        </select>
                    </div>

                    <div class="w-100 mx-2">
                        <label for="">Country</label>
                        <select class="form-control" name="country" id="">
                            <option value="united_kingdom">United Kingdom</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light w-100">See Campaign</button>
            </form>
        </div>
    </div>
</div>
@endforeach


@endsection
