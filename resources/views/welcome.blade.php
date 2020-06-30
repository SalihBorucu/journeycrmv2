@extends('layouts.main')
@section('content')

<div id="app">
    @if(Auth::check())
    <div class="card">
        <div class="card-body">
            <h3>User Name: {{ Auth::user()->name }}</h3>
            <h3>User Role: {{ Auth::user()->userRole->name }}</h3>
            {{ gettype(Session::get('user_current_account')) }}
            <h3>Account</h3>
            <form action="/useraccount" method="post">
                @csrf
                <select class="form-control m-2" name="user_account">
                    @foreach (Auth::user()->userAccounts as $item)
                    <option value={{ $item->accounts->id }} {{ Session::get('user_current_account') == $item->accounts->id ? 'selected' : ''}}>
                        {{ $item->accounts->name }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Change Accounts</button>
            </form>
            {{-- <h1> {{ Session::get('user_current_account') }} </h1> --}}
            <div class="">
                <div>
                    <h3>Campaign:</h3>
                    <ul>
                        @foreach ($campaigns as $campaign)
                        <li>Name: {{ $campaign->campaign->name }}
                            Schedule: {{ $campaign->campaign->schedule->name }}
                            StepCount: {{ sizeof($campaign->campaign->schedule->steps) }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="">
                <h3>Example Leads</h3>
                <ul>
                    @foreach ($leads as $lead)
                    <li>Name: {{ $lead->first_name." ".$lead->last_name }}
                        Company: {{ $lead->company }}
                        Title: {{ $lead->title }}
                        Email: {{ $lead->email }}
                        Phone: {{ $lead->phone }}
                        Current Step: {{ $lead->leadAccounts->find(Session::get('user_current_account')) }}
                    </li>
                    @endforeach
                </ul>
            </div>
{{--
            <div>
                <ul>
                @foreach ($steps as $step)
                    <li>{{ $step->type }}</li>
                @endforeach
                </ul>
            </div> --}}


        </div>
    </div>
    @endif
    {{-- <example-component></example-component> --}}
</div>

@endsection
