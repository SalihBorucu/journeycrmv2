@extends('layouts.main')
@section('content')

<div id="app">
    <leads-list-main
    :leads='{{ json_encode($leads) }}'></leads-list-main>
</div>

@endsection
