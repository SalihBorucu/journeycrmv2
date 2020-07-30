<?php

use App\CampaignSchedule;
use App\Step;
use App\Schedule;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //standard campaign steps
        $campaignScheduleIds = CampaignSchedule::all();

        $types = ['email', 'social', 'call'];
        $steps = [];

        foreach ($campaignScheduleIds as $key => $value) {
            $stepCount = rand(15, 21);

            for ($i=1; $i < $stepCount; $i++) {
                $randomType = $types[array_rand($types, 1)];

                $steps[] = [
                    'campaign_schedule_id' => $value->id,
                    'step_number' => $i,
                    'type' => $randomType,
                    'day_gap' => rand(0, 3)
                ];
            };
        }

        foreach ($types as $key => $value) {
            Step::create ([
                'step_number' => 1,
                'type' => $value,
                'schedule_id' => 6
            ]);
        }

        Step::insert($steps);
    }
}

// if ($schedule['name'] === 'Dnc') {
//     $steps[] = [
//         'schedule_id' => 7,
//         'name' => $schedule['name'],
//         'step_number' => 1,
//         'type' => null,
//         'day_gap' => null
//     ];
// }

// if ($schedule['name'] === 'Completed') {
//     $steps[] = [
//         'schedule_id' => 9,
//         'name' => $schedule['name'],
//         'step_number' => 1,
//         'type' => null,
//         'day_gap' => null
//     ];
// }

// if ($schedule['name'] === 'Custom Step') {
//     foreach ($types as $key => $type) {
//         $steps[] = [
//             'schedule_id' => 8,
//             'name' => $schedule['name'],
//             'step_number' => $key,
//             'type' => $type,
//             'day_gap' => 1
//         ];
//     }
// }
