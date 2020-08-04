<?php

namespace App\Http\Controllers;

use App\CampaignSchedule;
use App\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function update($campaignScheduleId)
    {
        $campaignSchedule = CampaignSchedule::findOrFail($campaignScheduleId);

        $currentStepIds = $campaignSchedule->steps->pluck('id')->toArray();

        $newStepIds = array_map(function ($step) {
            return array_key_exists('id', $step) ? $step['id'] : null;
        }, request('steps_array'));
        $stepIdsToDelete = array_diff($currentStepIds, $newStepIds);
        // $stepIdsToCreate = array_diff($newStepIds, $currentStepIds);


        foreach (request('steps_array') as $key => $step) {
            if (!array_key_exists('id', $step)) {
                Step::create([
                    'campaign_schedule_id' => $campaignScheduleId,
                    'schedule_id' => null,
                    'step_number' => $step['step_number'],
                    'type' => $step['type'],
                    'day_gap' => $step['day_gap']
                ]);
            } else {
                Step::find($step['id'])->update([
                    'campaign_schedule_id' => $campaignScheduleId,
                    'schedule_id' => null,
                    'step_number' => $step['step_number'],
                    'type' => $step['type'],
                    'day_gap' => $step['day_gap']
                ]);
            }
        }
        Step::destroy($stepIdsToDelete);
    }
}
