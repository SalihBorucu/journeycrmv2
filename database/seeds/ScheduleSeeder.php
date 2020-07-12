<?php

use App\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            'Outbound' => ['standard', 1],
            'Inbound' => ['standard', 2],
            'Event' => ['standard', 3],
            'Email Only' => ['standard', 4],
            'Qualified' => ['standard', 5],
            'Interested' => ['standard', 6],
            'Dnc' => ['standard', 7],
            'Custom Step' => ['standard', 8],
            'Completed' => ['standard', 9]
        ];

        foreach ($schedules as $name => $values) {
            Schedule::create([
                'name' => $name,
                'type' => $values[0],
                'steps_id' => $values[1]
            ]);
        };
    }
}
