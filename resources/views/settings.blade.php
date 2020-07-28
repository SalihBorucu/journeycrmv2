@extends('layouts.main')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Settings</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="settings-app">
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>

@endsection
