@extends('layouts.main')
@section('content')

<div>
    <ul>
        @foreach ($leads as $leadAccount)
        <li>{{ $leadAccount->lead->first_name }}</li>
        @endforeach
    </ul>
</div>

@endsection
