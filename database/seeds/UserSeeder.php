<?php

use App\User;
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
            User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'user_role_id' => $user[3]
                //account_id
            ]);
        }
    }
}
