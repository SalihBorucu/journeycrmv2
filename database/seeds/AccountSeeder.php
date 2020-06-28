<?php

use App\Account;
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
        $accounts = [ 'Account1', 'account2', 'account3', 'account4', 'account5', 'account6'];

        foreach ($accounts as $account) {
            Account::create(['name' => $account]);
        }
    }
}
