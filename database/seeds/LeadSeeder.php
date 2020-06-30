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
        factory(Lead::class, 200)->create()->each(
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

                    LeadAccount::create([
                        'lead_id' => $item->id,
                        'account_id' => $randomAccount,
                        'campaign_id' => $randomCampaignId,
                        'schedule_id' => $schedule->id,
                        'step_id' => $randomStepId,
                    ]);
                }
            }
        );


    }
}
