@extends('layouts.main')
@section('content')
<div id="reporting-app" class="container-fluid">
    <reporting-component
    :accounts="{{ json_encode($accounts) }}"
    :campaigns-inj="{{ json_encode($campaigns) }}"
    {{-- :companies-inj="{{ json_encode($companies) }}" --}}
    :results-inj="{{ json_encode($results) }}"
    >
</reporting-component>
</div>

@endsection
