@extends('layouts.main')
@section('content')
<div class="row">
    <h1>PAGE UNDER CONSTRUCTION</h1>
    <div class="col-xl-12">
        <div class="card m-b-30">
            <h5 class="card-header mt-0">{{ $account->name }}</h5>
            <div class="card-body">
                <h4 class="card-title font-16 mt-0">Company Analysis Page</h4>
                <select class="form-control my-2">
                    @foreach ($companies as $company)
                        <option value="{{ $company }}">{{ $company }}</option>
                    @endforeach
                </select>
                <a href="#" class="btn btn-primary">See Leads</a>
            </div>
        </div>
    </div>
</div>

@if ($leads)
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <h5 class="card-header mt-0">{{ $account->name }}</h5>
            <div class="card-body">
                <table class="table table-striped mb-0 mt-2">
                    <tbody>
                        <th>
                            <tr>
                                <th>Lead Name</th>
                            </tr>
                        </th>
                        <tr>
                            <td>Email</td>
                            <td>
                                {{ Auth::user()->email }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
