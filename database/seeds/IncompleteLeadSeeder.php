<?php

use App\IncompleteLead;
use App\Lead;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class IncompleteLeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leads = [];
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $leads[] = [
                'first_name' => array($faker->firstName, null)[rand(0,1)],
                'last_name' => $faker->lastName,
                'company_name' => array($faker->company, null)[rand(0,1)],
                'country' => array($faker->country, null)[rand(0,1)],
                'title' => array($faker->jobTitle, null)[rand(0,1)],
                'linkedin' => $faker->url,
                'user_id' => rand(0, 2),
                'unassigned' => true
            ];
        }

        IncompleteLead::insert($leads);
    }
}
