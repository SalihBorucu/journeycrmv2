<?php

namespace App\Http\Controllers;

use App\Account;
use App\Campaign;
use App\CampaignSchedule;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create()
    {
        $campaign = Campaign::create([
            'name' => request('campaign_name'),
            'description' => request('campaign_description'),
            'account_id' => request('account_id')
        ]);

        foreach (request('campaign_schedules') as $key => $value) {
            CampaignSchedule::firstOrCreate([
                'schedule_id' => $value['id'],
                'campaign_id' => $campaign->id
            ]);
        }

        $account = Account::with(['campaigns.campaignSchedules.steps.template', 'userAccounts.user', 'campaigns.campaignSchedules.schedule'])->findOrFail($campaign->account_id);

        return response()->json($account);
    }

    public function update($campaignId)
    {
        $campaign = Campaign::with(['campaignSchedules'])->findOrFail($campaignId);
        $campaign->update([
            'name' => request('campaign_name'),
            'description' => request('campaign_description')
        ]);

        $newScheduleIds = array_map(function ($schedule) {
            return $schedule['id'];
        }, request('campaign_schedules'));

        $scheduleIdsToDelete = array_diff($campaign->campaignSchedules->pluck('id')->toArray(), $newScheduleIds);

        foreach ($scheduleIdsToDelete as $key => $value) {
            CampaignSchedule::where([['schedule_id', $value], ['campaign_id', $campaignId]])->delete();
        }

        foreach (request('campaign_schedules') as $key => $value) {
            CampaignSchedule::firstOrCreate([
                'schedule_id' => $value['id'],
                'campaign_id' => $campaignId
            ]);
        }

        $account = Account::with(['campaigns.campaignSchedules.steps.template', 'userAccounts.user', 'campaigns.campaignSchedules.schedule'])->findOrFail($campaign->account_id);

        return response()->json($account);
    }

    public function destroy($campaignId){
        Campaign::destroy($campaignId);

        return response()->json();
    }
}
