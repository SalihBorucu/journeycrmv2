<?php

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
        $this->call(ScheduleSeeder::class);
        $this->call(OutcomeSeeder::class);
        $this->call(UserRoleSeeder::class);

        $this->call(AccountSeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(StepTemplateSeeder::class);
        $this->call(IncompleteLeadSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(GlobalLeadNotesSeeder::class);
        $this->call(ActivityHistorySeeder::class);
    }
}
