@extends('layouts.main')
@section('content')

<div id="app">
    @if(Auth::check())
    <div class="card">
        <div class="card-body">
            <h3>User Name: {{ Auth::user()->name }}</h3>
            <h3>User Role: {{ Auth::user()->userRole->name }}</h3>

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
            <div class="d-flex justify-content-around">
                <div>
                    <h3>Campaign:</h3>
                    <ul>
                        @foreach ($campaigns as $campaign)
                            <li>Name: {{ $campaign->campaigns->name }} Type: {{ $campaign->campaigns->type }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3>Schedules:</h3>
                </div>
            </div>


        </div>
    </div>
    @endif
    {{-- <example-component></example-component> --}}
</div>

@endsection
