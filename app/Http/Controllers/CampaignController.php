<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create(){
        Campaign::create([
            'name' => request('campaign_name'),
            'definition' => request('campaign_definition'),
            'type' => request('campaign_type'),
            'schedule_id' => request('schedule_id')
        ]);

        $this->flashSuccess("Campaign created successfully");

        return redirect()->back();
    }
}
