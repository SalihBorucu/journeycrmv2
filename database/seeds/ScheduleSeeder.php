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
            'Prospecting',
            'Email Only' ,
            'Qualified',
            'Interested',
            'Dnc',
            'Custom Step',
            'Completed'
        ];

        foreach ($schedules as $name => $values) {
            Schedule::create([
                'name' => $values,
            ]);
        };
    }
}
