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
        $now = \Carbon\Carbon::now();

        for ($i=0; $i < (int)getenv('TEST_SEED_NUMBER')*1.75; $i++) {
            $notes[] =
            [
                'lead_id' => $leads[array_rand($leads, 1)],
                'user_id' => $users[array_rand($users, 1)],
                'note' => $faker->sentence(5),
                'score' => rand(1, 10),
                "created_at" =>  $now,
                "updated_at" => $now,
            ];
        }
        $collection = collect($notes);
        $chunks = $collection->chunk(1000);
        $chunks->toArray();

        foreach ($chunks as $chunk) {
            GlobalLeadNotes::insert($chunk->toArray());
        }
    }
}
