@extends('layouts.main')
@section('content')
<div class="jumbotron">
    <h4 class="page-title mb-2">{{ $account }}'s Campaigns</h4>
    @foreach ($campaigns as $campaign)
    <div class="row">
        <div class="w-100">
            <div class="card m-b-30 card-body">
                <form action="/activities/campaign/{{ $campaign->campaign_id }}" method="GET">
                    <h4 class="card-title font-16 mt-0">{{ $campaign->campaign->name }}</h4>
                    <p class="card-text"> {{ $campaign->campaign->definition }}</p>
                    <div class="d-flex justify-content-around mb-2">
                        <div class="w-100 mx-2">
                            <label for="">Activity Type</label>
                            <select class="form-control" name="activity_type">
                                <option value="email">Email</option>
                                <option value="social">Social</option>
                                <option value="call" selected>Phone</option>
                            </select>
                        </div>
                        <div class="w-100 mx-2">
                            <label for="">Lead Stage</label>
                            <select class="form-control" name="lead_stage">
                                <option value="prospecting">Prospecting</option>
                                <option value="interested">Interested</option>
                                <option value="qualified">Qualified</option>
                                <option value="no_phone">Email_only</option>
                            </select>
                        </div>

                        <div class="w-100 mx-2">
                            <label for="">Country</label>
                            <select class="form-control" name="country">
                                <option value="united_kingdom">United Kingdom</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around mb-2">
                        <div class="w-100 mx-2">
                            <label for="example-date-input">Starting Date</label>
                            <input class="form-control" type="date" name="start_date" id="start_date">
                        </div>

                        <div class="w-100 mx-2">
                            <label for="example-date-input">End Date</label>
                            <input class="form-control" type="date" name="end_date" id="end_date">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100 mt-3">See Campaign</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<script>
let today = new Date();
let res = today.toISOString().replace(/\T(.*)/g, '');

window.onload = () =>
    {
        document.getElementById('end_date').value = res
        document.getElementById('start_date').value = res
    }

</script>
