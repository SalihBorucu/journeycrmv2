<?php

use App\Account;
use App\Campaign;
use App\AccountCampaign;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [ 'Oceanian', 'Trux', 'Supply Chainero', 'Imaginary Corp', 'Salesorio', 'Mocrosoft'];

        foreach ($accounts as $account) {
            $account = Account::create(['name' => $account]);
            $campaignIds = Campaign::pluck('id')->toArray();

            for ($i = 0; $i <= rand(0, 2); $i++) {
                $randomCampaignId = array_rand($campaignIds, 1);
                $randomCampaign = $campaignIds[$randomCampaignId];
                unset($campaignIds[$randomCampaignId]);

                AccountCampaign::create([
                    'account_id' => $account->id,
                    'campaign_id' => $randomCampaign
                ]);
            }
        }
    }
}
