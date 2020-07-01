<?php

use App\GlobalLeadNotes;
use Illuminate\Database\Seeder;

class GlobalLeadNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GlobalLeadNotes::class, 50)->create();
    }
}
