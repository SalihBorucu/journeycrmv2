<?php

use App\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaigns = [
            'Outbound' => ['outbound', 1],
            'Inbound' => ['inbound', 2],
            'Event' => ['event', 3]
        ];

        foreach ($campaigns as $name => $type) {
            Campaign::create([
                'name' => $name,
                'type' => $type[0],
                'schedule_id' => $type[1]
            ]);
        }
    }
}
