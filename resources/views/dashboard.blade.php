@extends('layouts.main')
@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="page-title m-0">Welcome {{ Auth::user()->name }}</h4>

                    <table class="table table-striped mb-0 mt-2">
                        <tbody>
                            <tr>
                                <td>Email</td>
                                <td>
                                    {{ Auth::user()->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Current Account</td>
                                <td>
                                    <form action="/useraccount" method="post">
                                        @csrf
                                        <div class="d-flex">
                                            <select class="form-control" name="user_account">
                                                @foreach (Auth::user()->userAccounts as $item)
                                                <option value={{ $item->accounts->id }} {{ Session::get('user_current_account') == $item->accounts->id ? 'selected' : ''}}>
                                                    {{ $item->accounts->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary mx-2 w-50">Swap Account</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Current Phone</td>
                                <td>
                                    <div class="d-flex">
                                        <select name="" id="" class="form-control">
                                            <option value="+0572878347">+0572878347</option>
                                            <option value="+0572878123">+05728783123</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary mx-2 w-50">Swap Number</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Quarter Breakdown</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings mr-1"></i> Quarter
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                    <a class="dropdown-item" href="#">Q1</a>
                                    <a class="dropdown-item" href="#">Q2</a>
                                    <a class="dropdown-item" href="#">Q3</a>
                                    <a class="dropdown-item" href="#">Q4</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Activities</h6>
                        <h4 class="mb-3 mt-0 float-right">1,587</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-info"> +11% </span> <span class="ml-2">Expected</span>
                    </div>

                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
                    </div>
                    <p class="font-14 m-0">Remaining : 1447</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Raised Interest</h6>
                        <h4 class="mb-3 mt-0 float-right">100</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-danger"> -29% </span> <span class="ml-2">Achieved</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
                    </div>
                    <p class="font-14 m-0">Remaining : 100</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Discovery Calls</h6>
                        <h4 class="mb-3 mt-0 float-right">10</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-primary"> 50% </span> <span class="ml-2">Achieved</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
                    </div>
                    <p class="font-14 m-0">Remaining : 10</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success mini-stat">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Opportunities</h6>
                        <h4 class="mb-3 mt-0 float-right">8</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-info"> +89% </span> <span class="ml-2">Achieved</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
                    </div>
                    <p class="font-14 m-0">Remaining : 3</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
