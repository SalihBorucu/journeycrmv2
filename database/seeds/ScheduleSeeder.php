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
            'Prospecting'  => 'standard',
            'Email Only'  => 'standard',
            'Qualified' => 'standard',
            'Interested'=> 'standard',
            'Dnc'  => 'support',
            'Custom Step' => 'support',
            'Completed' => 'support',
        ];

        foreach ($schedules as $name => $value) {
            Schedule::create([
                'name' => $name,
                'type' => $value
            ]);
        };
    }
}
