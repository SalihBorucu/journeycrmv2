<?php

use App\Company;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $companies = [];
        for ($i=0; $i < (int)getenv('TEST_SEED_NUMBER')/10 ; $i++) {
            $companies[] = [
                'name' => $faker->company,
                'tools_note' => "SAP, Oracle, SFDC, Jira, Vmware.."
            ];
        }

        $collection = collect($companies);
        $chunks = $collection->chunk(1000);
        $chunks->toArray();

        foreach ($chunks as $chunk) {
            Company::insert($chunk->toArray());
        }
    }
}
