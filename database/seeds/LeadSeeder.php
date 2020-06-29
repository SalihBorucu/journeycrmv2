<?php

use App\Lead;
use App\Account;
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

                    LeadAccount::create([
                        'lead_id' => $item->id,
                        'account_id' => $randomAccount,
                        // 'history_id'
                        'current_step' => rand(1, 13)
                    ]);
                }
            }
        );


    }
}
