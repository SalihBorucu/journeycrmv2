<?php

use App\Steps;
use App\Schedule;
use Illuminate\Database\Seeder;

class StepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = Schedule::get()->toArray();
        $types = ['email', 'social', 'call'];
        $steps = [];
        foreach ($schedules as $key => $schedule) {
            $stepCount = rand(15, 21);
            for ($i=1; $i < $stepCount; $i++) {
                $steps[] = [
                    'schedule_id' => $schedule['id'],
                    'name' => $schedule['name'],
                    'step_number' => $i,
                    'type' => $types[array_rand($types, 1)],
                    'day_gap' => rand(0, 3)
                ];
            };
        }
        Steps::insert($steps);
    }
}
