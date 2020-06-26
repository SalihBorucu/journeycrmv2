@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row align-items-center">

        <div class="col-lg-5 offset-lg-3">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="p-2">
                        <h4 class="text-muted float-right font-18 mt-4">Register</h4>
                        <div class="row ml-1">
                            {{-- <a href="#" class="logo logo-admin mt-3"><img src="images/favicon.ico" height="28" alt="logo"> --}}
                            </a>
                            <h2 class="ml-2">EandP</h2>
                        </div>
                    </div>

                    <div class="p-2">
                        <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="name" type="name" required="" placeholder="Full Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="email" type="email" required="" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input id="password" class="form-control @error('password') is-invalid @enderror" name="password" type="password" required placeholder="Password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="password_confirmation" id="password-confirm" type="password" required placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label font-weight-normal" for="customCheck1">I
                                            accept <a href="#" class="text-primary">Terms and Conditions</a></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20 text-center">
                                    <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
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
