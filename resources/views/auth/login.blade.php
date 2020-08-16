@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row align-items-center">

        <div class="col-lg-5 offset-lg-3">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="p-2">
                        <h4 class="text-muted float-right font-18 mt-4">Sign In</h4>
                        <div class="row ml-1">

                            {{-- <a href="#" class="logo logo-admin mt-3"><img src="images/favicon.ico" height="28" alt="logo"> --}}
                            </a>
                            <h2 class="ml-2">Journey CRM</h2>
                        </div>
                    </div>

                    <div class="p-2">
                        <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="email" required="" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" required autocomplete="current-password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7 m-t-20">
                                    <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i>
                                        Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
@endsection
