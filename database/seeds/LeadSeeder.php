<?php

use App\Lead;
use App\Steps;
use App\Account;
use App\Campaign;
use App\Schedule;
use App\LeadAccount;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leadAccountsArr = [];
        $leads = [];
        $faker = Faker::create();

        foreach (range(1, 20000) as $index) {
            $leads[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'company' => $faker->company,
                'country' => $faker->country,
                'title' => $faker->jobTitle,
                'email' => $faker->companyEmail,
                'phone' => $faker->e164PhoneNumber,
                'linkedin' => $faker->url
            ];
        }

        $collection = collect($leads);
        $chunks = $collection->chunk(1000);
        $chunks->toArray();

        foreach ($chunks as $chunk) {
            Lead::insert($chunk->toArray());
        }

        $leadIds = Lead::pluck('id');
        $accounts = Account::pluck('id')->toArray();
        $allAccounts = Account::get();
        $allCampaigns = Campaign::get();
        $allSchedules = Schedule::get();
        // dd($allAccounts->find(1));
        // dd($createdLeads);
        foreach ($leadIds as $item) {
            for ($i=0; $i < rand(1,3); $i++) {
                $randomAccount = $accounts[array_rand($accounts, 1)];
                unset($accounts[$randomAccount]);

                $randomCampaign = $allAccounts->find($randomAccount)->accountCampaigns->toArray();
                $randomCampaignId = $randomCampaign[array_rand($randomCampaign, 1)]['campaign_id'];
                $schedule = $allCampaigns->find($randomCampaignId)->schedule;

                $steps = $allSchedules->find($schedule->id)->steps->toArray();
                $randomStepId = $steps[array_rand($steps, 1)]['id'];

                $dueDates = [
                    '2020-07-04',
                    '2020-07-01',
                    '2020-06-01',
                    date("y-m-d")
                ];

                $leadAccountsArr[] = [
                    'lead_id' => $item,
                    'account_id' => $randomAccount,
                    'campaign_id' => $randomCampaignId,
                    'schedule_id' => $schedule->id,
                    'step_id' => $randomStepId,
                    'due_date' => $dueDates[array_rand($dueDates, 1)]
                ];
            }
        }

        $collection1 = collect($leadAccountsArr);
        $chunks1 = $collection1->chunk(1000);
        $chunks1->toArray();

        foreach ($chunks1 as $chunk) {
            LeadAccount::insert($chunk->toArray());
        }

    }
}
