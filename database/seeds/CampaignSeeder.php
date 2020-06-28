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
            'campaign1' => 'outbound',
            'campaign2' => 'inbound',
            'campaign3' => 'event'
        ];

        foreach ($campaigns as $name => $type) {
            Campaign::create([
                'name' => $name,
                'type' => $type,
            ]);
        }
    }
}
