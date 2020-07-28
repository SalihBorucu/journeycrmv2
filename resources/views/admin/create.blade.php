@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card m-b-30 card-body">
            <form action="/account" method="POST">
                @csrf
                <h3 class="card-title font-16 mt-0">Create Account</h3>
                <label for="">Account Name</label>
                <input type="text" class="form-control" name="account_name">
                <label for="">Attach Campaign</label>
                <select type="text" class="form-control" name="campaign_id">
                    @foreach ($campaigns as $campaign)
                    <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary waves-effect waves-light mt-2">Create Account</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card m-b-30 card-body">
            <form action="/campaign" method="POST">
                @csrf
                <h3 class="card-title font-16 mt-0">Create Campaign</h3>
                <label for="">Campaign Name</label>
                <input type="text" class="form-control" name="campaign_name">
                <label for="">Definition</label>
                <input type="text" class="form-control" name="campaign_definition">
                <label for="">Campaign Type</label>
                <select type="text" class="form-control" name="campaign_type">
                    @foreach ($campaigns as $campaign)
                    <option value="{{ $campaign->type }}">{{ $campaign->type }}</option>
                    @endforeach
                </select>
                <label for="">Attach Schedule</label>
                <select type="text" class="form-control" name="schedule_id">
                    @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary waves-effect waves-light mt-2">Create Campaign</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card m-b-30 card-body" id="admin-app">
            <create-schedule></create-schedule>
        </div>
    </div>
</div>
@endsection
