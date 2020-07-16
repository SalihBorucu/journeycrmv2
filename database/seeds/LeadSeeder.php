<?php

use App\Lead;
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
                'company_id' => rand(1, 5000),
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
        $allAccounts = Account::get();
        $allCampaigns = Campaign::get();
        $allSchedules = Schedule::get();
        $accountIdsX = [];

        foreach ($leadIds as $item) {
            $accountIds = Account::pluck('id')->toArray();
            for ($i = 0; $i < rand(1, 3); $i++) {
                $randomAccountId = $accountIds[array_rand($accountIds, 1)];
                unset($accountIds[$randomAccountId]);
                $accountIdsX[] = $randomAccountId;
                $randomCampaign = $allAccounts->find($randomAccountId)->accountCampaigns->toArray();
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

                $randomStatus = ['prospecting', 'interested', 'qualified'];

                $leadAccountsArr[] = [
                    'lead_id' => $item,
                    'account_id' => $randomAccountId,
                    'campaign_id' => $randomCampaignId,
                    'schedule_id' => $schedule->id,
                    'step_id' => $randomStepId,
                    'due_date' => $dueDates[array_rand($dueDates, 1)],
                    'current_status' => $randomStatus[array_rand($randomStatus, 1)]
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
