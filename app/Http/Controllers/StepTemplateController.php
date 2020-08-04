<?php

namespace App\Http\Controllers;

use App\Step;
use App\StepTemplate;
use Illuminate\Http\Request;

class StepTemplateController extends Controller
{
    public function update($id)
    {
        // dd(request()->all());
        StepTemplate::find($id)->update([
            'pointer' => request('pointer'),
            'name' => 'need to craft',
            'email_subject' => request('email_subject'),
            'email_content' => request('email_content')
        ]);
    }

    public function create()
    {
        $step = Step::create([
            'campaign_schedule_id' => request('step')['campaign_schedule_id'],
            'schedule_id' => null,
            'step_number' => request('step')['step_number'],
            'type' => request('step')['type'],
            'day_gap' => request('step')['day_gap']
        ]);

        StepTemplate::create([
            'pointer' => request('pointer'),
            'name' => 'need to craft',
            'email_subject' => request('email_subject'),
            'email_content' => request('email_content'),
            'step_id' => $step->id
        ]);
    }
}
