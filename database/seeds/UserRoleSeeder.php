<?php

use App\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = [
            'standard' => ['Standard', 'This is the standard user, can only read and log activities'],
            'admin' => ['Admin', 'This is the admin user, can do everything.'],
            'demo' => ['Demo User', 'This user has only read access, can not make calls or send emails.']
        ];
        foreach ($userRoles as $key => $userRole) {
            UserRole::create([
                'name' => $userRole[0],
                'description' => $userRole[1]
            ]);
        }
    }
}
