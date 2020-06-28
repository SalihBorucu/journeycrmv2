@extends('layouts.main')
@section('content')

<div id="app">
    @if(Auth::check())
        <h3>
            <span>{{ Auth::user()->name }}</span>
            <span>{{ Auth::user()->userRole->name }}</span>
        </h3>
        <select class="form-control">
            @foreach (Auth::user()->userAccounts as $item)
                <option value="">{{ $item->accounts->name }} </option>
            @endforeach
        </select>
    @endif
    {{-- <example-component></example-component> --}}
</div>

@endsection
