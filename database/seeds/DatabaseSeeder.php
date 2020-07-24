<?php

use App\GlobalLeadNotes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(IncompleteLeadSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(OutcomeSeeder::class);
        $this->call(StepsSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(GlobalLeadNotesSeeder::class);
        $this->call(ActivityHistorySeeder::class);
    }
}
