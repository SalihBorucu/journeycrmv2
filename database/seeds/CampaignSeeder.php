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
            'Outbound' => [
                'outbound',
                1,
                'This campaign focuses on leads that did not have any previous interactions with the account'
                    ],
            'Inbound' => [
                'inbound',
                2,
                'This campaign has leads that were received from the client\'s marketing efforts.'
            ],
            'Event' => [
                'event',
                3,
                'This campaign involves leads that had an interaction with X Event at X country.'
                ]
        ];

        foreach ($campaigns as $name => $type) {
            Campaign::create([
                'name' => $name,
                'type' => $type[0],
                'schedule_id' => $type[1],
                'definition' => $type[2]
            ]);
        }
    }
}
