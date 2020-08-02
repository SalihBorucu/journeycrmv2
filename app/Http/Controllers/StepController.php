<?php

namespace App\Http\Controllers;

use App\CampaignSchedule;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function update($campaignScheduleId){
        $campaignSchedule = CampaignSchedule::findOrFail($campaignScheduleId);

        $steps = $campaignSchedule->steps;


    }
}
