<?php

use App\Lead;
use App\Account;
use App\Campaign;
use App\CampaignSchedule;
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
                'phone_1' => $faker->e164PhoneNumber,
                'linkedin' => $faker->url,
                'user_id' => rand(0, 2),
                'unassigned' => false
            ];
        }

        $collection = collect($leads);
        $chunks = $collection->chunk(1000);
        $chunks->toArray();

        foreach ($chunks as $chunk) {
            Lead::insert($chunk->toArray());
        }

        $leadIds = Lead::pluck('id');
        $allAccounts = Account::with(['campaigns'])->get();
        $accountIdsX = [];
        $leadAccountsArr = [];

        foreach ($leadIds as $key => $leadId) {
            $accountIds = Account::pluck('id')->toArray();
            for ($i = 1; $i < rand(1, 4); $i++) {
                $randomAccountIndex = array_rand($accountIds, 1);
                $randomAccountId = $accountIds[$randomAccountIndex];
                unset($accountIds[$randomAccountIndex]);
                $accountIdsX[] = $randomAccountId;

                $campaignIds = $allAccounts->find($randomAccountId)->campaigns->pluck('id')->toArray();
                $randomCampaignId = $campaignIds[array_rand($campaignIds, 1)];
                $randomScheduleId = mt_rand(1, 4);
                $campaignSchedule = CampaignSchedule::where([['campaign_id', $randomCampaignId], ['schedule_id', $randomScheduleId]])->with(['steps'])->get()->toArray();
                $randomStepId = $campaignSchedule[0]['steps'][array_rand($campaignSchedule[0]['steps'])]['id'];

                $dueDates = [
                    '2020-07-04',
                    '2020-07-01',
                    '2020-06-01',
                    date("y-m-d")
                ];

                switch ($randomScheduleId) {
                    case 3:
                        $currentStatus = 'interested';
                        break;
                    case 1:
                        $currentStatus = 'qualified';
                        break;

                    default:
                        $currentStatus = 'prospecting';
                        break;
                }

                $leadAccountsArr[] = [
                    'lead_id' => $leadId,
                    'account_id' => $randomAccountId,
                    'campaign_id' => $randomCampaignId,
                    'schedule_id' => $randomScheduleId,
                    'step_id' => $randomStepId,
                    'due_date' => $dueDates[array_rand($dueDates, 1)],
                    'current_status' => $currentStatus
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
