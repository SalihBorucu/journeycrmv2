<?php

use App\User;
use App\Account;
use App\ActivityHistory;
use App\Outcome;
use App\LeadAccount;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ActivityHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activityHistories = [];
        $faker = Faker::create();
        $leadIds = LeadAccount::pluck('id')->toArray();
        $accountIds = Account::pluck('id')->toArray();
        $outcomeIds = Outcome::pluck('id')->toArray();
        $activityTypes = ['email', 'social', 'call'];
        $userIds = User::pluck('id')->toArray();

        foreach ($leadIds as $leadId) {
            $activityHistories[] = [
            'user_id' => $userIds[array_rand($userIds, 1)],
            'lead_account_id' => $leadId,
            'account_id' => $accountIds[array_rand($accountIds, 1)],
            'outcome_id' => $outcomeIds[array_rand($outcomeIds, 1)],
            'type' => $activityTypes[array_rand($activityTypes, 1)],
            'notes' => $faker-> realText($maxNbChars = 500, $indexSize = 2)
            ];
        }

        $collection = collect($activityHistories);
        $chunks = $collection->chunk(1000);
        $chunks->toArray();

        foreach ($chunks as $chunk) {
            ActivityHistory::insert($chunk->toArray());
        }
    }
}
