<?php

use App\User;
use App\Account;
use App\UserAccount;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'standard1' => ['Salih Borucu1', 'salih@hotmail.com', '12345678', 1],
            'standard' => ['Salih Borucu', 'salihborucu@hotmail.com', '12345678', 1],
            'admin' => ['Admin Admin', 'admin@crm.com', '12345678', 2]
        ];

        foreach ($users as $key => $user) {
            $user = User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'user_role_id' => $user[3]
            ]);

            $accountIds = Account::pluck('id')->toArray();

            for ($i=0; $i <= rand(0, 2); $i++) {
                $randomAccount = $accountIds[array_rand($accountIds, 1)];
                unset($accountIds[$randomAccount]);

                UserAccount::create([
                    'user_id' => $user->id,
                    'account_id' => $randomAccount
                ]);
            }
        }
    }
}
