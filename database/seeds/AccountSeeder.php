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
        $accounts = [ 'Oceanian', 'Logisorio', 'Supply Chainero', 'Imaginary Corp', 'Salesorio', 'Mocrisoft', 'Dev Stats', 'Incidentinie', 'Monitorio'];

        foreach ($accounts as $account) {
            $account = Account::create(['name' => $account, 'complete' => true]);
        }
    }
}
