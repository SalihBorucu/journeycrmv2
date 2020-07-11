<?php

use App\Outcome;
use Illuminate\Database\Seeder;

class OutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outcomes = [
            'dnc' => [true, 7],
            'no_answer' => [false, null],
            'call_back' => [false, null],
            'interested' => [true, 6],
            'qualified' => [true, 5],
            'no_phone' => [true, 4],
        ];

        foreach ($outcomes as $key => $value) {
            Outcome::create([
                'type' => $key,
                'leads_to_new_schedule' => $value[0],
                'new_schedule_id' => $value[1]
            ]);
        };
    }
}
