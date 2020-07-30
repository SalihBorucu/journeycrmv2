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
            'dnc' => [true, 5],
            'no_answer' => [false, null],
            'call_back' => [true, 6],
            'interested' => [true, 4],
            'qualified' => [true, 3],
            'no_phone' => [true, 2],
            'message_sent' => [false, null],
            'message_not_sent' => [false, null]
        ];

        foreach ($outcomes as $key => $value) {
            Outcome::create([
                'name' => $key,
                'leads_to_new_schedule' => $value[0],
                'new_schedule_id' => $value[1]
            ]);
        };
    }
}
