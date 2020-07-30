<?php

use App\Account;
use App\Campaign;
use App\CampaignSchedule;
use App\Schedule;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountIds = Account::pluck('id');
        $campaigns = [];
        $campaignDetails = [
            1 => ['Outbound', 'This campaign is for leads that were researched internally.' ],
            2 => ['Inbound', 'This campaign is for leads that came from client\'s marketing efforts.'],
            3 => ['Event X', 'This campaign is for leads obtained from X event.']
        ];

        foreach ($accountIds as $key => $value) {
            for ($i=1; $i <= mt_rand(2, 3); $i++) {
                $campaigns[] = [
                    'name' => $campaignDetails[$i][0],
                    'description' => $campaignDetails[$i][1],
                    'account_id' => $value
                ];
            };
        }

        Campaign::insert($campaigns);
        $campaignIds = Campaign::pluck('id');
        $campaignSchedules = [];
        foreach ($campaignIds as $key => $value) {
            for ($i=1; $i <= 4; $i++) {
                $campaignSchedules[] = [
                    'campaign_id' => $value,
                    'schedule_id' => $i
                ];
            }
        }

        CampaignSchedule::insert($campaignSchedules);
    }
}
