<?php

use App\Lead;
use App\User;
use App\GlobalLeadNotes;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GlobalLeadNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker::create();

        $leads = Lead::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        for ($i=0; $i < 10000; $i++) {
            $notes[] =
            [
                'lead_id' => $leads[array_rand($leads, 1)],
                'user_id' => $users[array_rand($users, 1)],
                'note' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'score' => rand(1, 10)
            ];;
        }

        GlobalLeadNotes::insert($notes);
    }
}
