@extends('layouts.main')
@section('content')

<td> <a class="btn btn-success" onclick="callCustomer('+447504855932')">Call</a> </td>
<button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>



<script type="text/javascript" src="https://media.twiliocdn.com/sdk/js/client/v1.7/twilio.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

<script type="text/javascript" src="{{ URL::asset('js/twiliocall.js') }}"></script>
@endsection
