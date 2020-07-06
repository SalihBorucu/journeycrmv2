<?php

use App\Lead;
use App\Steps;
use App\Account;
use App\Campaign;
use App\Schedule;
use App\LeadAccount;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lead::class, 20000)->create()->each(
            function($item, $key){
                $accounts = Account::pluck('id')->toArray();
                for ($i=0; $i < rand(1,3); $i++) {
                    $randomAccount = $accounts[array_rand($accounts, 1)];
                    unset($accounts[$randomAccount]);

                    $randomCampaign = Account::find($randomAccount)->accountCampaigns->toArray();
                    $randomCampaignId = $randomCampaign[array_rand($randomCampaign, 1)]['campaign_id'];
                    $schedule = Campaign::find($randomCampaignId)->schedule;

                    $steps = Schedule::find($schedule->id)->steps->toArray();
                    $randomStepId = $steps[array_rand($steps, 1)]['id'];

                    $dueDates = [
                        '2020-07-04',
                        '2020-07-01',
                        '2020-06-01',
                        date("y-m-d")
                    ];

                    LeadAccount::create([
                        'lead_id' => $item->id,
                        'account_id' => $randomAccount,
                        'campaign_id' => $randomCampaignId,
                        'schedule_id' => $schedule->id,
                        'step_id' => $randomStepId,
                        'due_date' => $dueDates[array_rand($dueDates, 1)]
                    ]);
                }
            }
        );


    }
}
