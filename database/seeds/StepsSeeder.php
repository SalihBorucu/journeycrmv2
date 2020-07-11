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

            if ($schedule['name'] === 'Dnc') {
                $steps[] = [
                    'schedule_id' => 7,
                    'name' => $schedule['name'],
                    'step_number' => 1,
                    'type' => null,
                    'day_gap' => null
                ];
            }

            if ($schedule['name'] === 'Custom Step') {
                foreach ($types as $key => $type) {
                    $steps[] = [
                        'schedule_id' => 8,
                        'name' => $schedule['name'],
                        'step_number' => $key,
                        'type' => $type,
                        'day_gap' => 1
                    ];
                }
            }

            for ($i=1; $i < $stepCount; $i++) {
                $randomType = $types[array_rand($types, 1)];

                if($schedule['name'] === 'Email Only'){
                    $randomType = 'email';
                    $stepCount = 10;
                };

                if($schedule['name'] === 'Dnc') continue;
                if ($schedule['name'] === 'Custom Step') continue;

                $steps[] = [
                    'schedule_id' => $schedule['id'],
                    'name' => $schedule['name'],
                    'step_number' => $i,
                    'type' => $randomType,
                    'day_gap' => rand(0, 3)
                ];
            };
        }
        Steps::insert($steps);
    }
}
