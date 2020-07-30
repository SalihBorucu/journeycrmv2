<?php

use App\Account;
use App\StepTemplate;
use Illuminate\Database\Seeder;

class StepTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [];
        $accountIds = Account::with('accountCampaigns.campaign.schedule.')->pluck('id');
        dd($accountIds);
        // every account's campaign's schedules's, steps, should have a template



        for ($i = 0; $i < 2; $i++) {
            $templates[] = [
                'name' => 'Outbound Standard Email 1',
                'pointer' => 'null',
                'email_subject' => 'Here is the subject',
                'email_content' => '',
                'account_id' => 5,
                'campaign_id' => 1,
                'step_id' => 20
            ];
        }

        StepTemplate::insert($templates);
    }
}
