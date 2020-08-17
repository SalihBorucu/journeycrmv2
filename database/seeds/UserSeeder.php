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
            'standard' => ['Jane Doe', 'jane@doe.com', '12345678', 1],
            'admin' => ['Admin User', 'admin@user.com', '12345678', 2],
            'demo' => ['Demo User', 'demo@user.com', '12345678', 3],
        ];

        foreach ($users as $key => $user) {
            $user = User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'user_role_id' => $user[3],
                'twilio_number' => getenv('TWILIO_NUMBER')
            ]);

            $accountIds = Account::pluck('id')->toArray();

            for ($i = 0; $i <= rand(1, 3); $i++) {
                $randomAccountIndex = array_rand($accountIds, 1);
                $randomAccountId = $accountIds[$randomAccountIndex];
                unset($accountIds[$randomAccountIndex]);

                UserAccount::create([
                    'user_id' => $user->id,
                    'account_id' => $randomAccountId
                ]);
            }
        }
    }
}
