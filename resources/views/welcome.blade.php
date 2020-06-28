@extends('layouts.main')
@section('content')

<div id="app">
    <h3>
        <span>{{ Auth::user()->name }}</span>
        <span>{{ Auth::user()->userRole->name }}</span>
    </h3>
    {{-- <example-component></example-component> --}}
</div>

@endsection
