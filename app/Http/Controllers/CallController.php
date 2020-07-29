<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{

    public function newCall()
    {
        $response = new VoiceResponse();
        $callerIdNumber = getenv('TWILIO_NUMBER');

        $dial = $response->dial(null, ['callerId' => $callerIdNumber]);
        $phoneNumberToDial = request('phoneNumber');

        $dial->number($phoneNumberToDial);

        return $response;

        echo $response;
    }


    public function newToken(ClientToken $clientToken = null)
    {
        $clientToken = new ClientToken(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));

        // $forPage = request('forPage');
        $applicationSid = 'APb7656758ff5fed30048ac180c159a805';

        $clientToken->allowClientOutgoing($applicationSid);


        $token = $clientToken->generateToken();

        return response()->json(['token' => $token]);
    }
}
