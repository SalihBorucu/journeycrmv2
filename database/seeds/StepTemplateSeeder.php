<?php

use App\Step;
use App\StepTemplate;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StepTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [];
        $faker = Faker::create();
        $steps = Step::get();

        foreach ($steps as $key => $value) {
            if ($value->type === 'email') {
                $templates[] = [
                    'name' => 'Outbound Standard Email 1',
                    'pointer' => '',
                    'email_subject' => $faker->realText($maxNbChars = 50, $indexSize = 1),
                    'email_content' => '<p><b>Hi $lead_first_name</b>,<br>I head that at $lead_company you are using $lead_company_tools.' . $faker->realText($maxNbChars = 1000, $indexSize = 4) . '</p>',
                    'step_id' => $value->id,
                ];
            } else if($value->type === 'call') {
                $templates[] = [
                    'name' => 'Outbound Standard Email 1',
                    'pointer' => 'Hello my name is X and I am calling from X' . $faker->realText($maxNbChars = 200, $indexSize = 2),
                    'email_subject' => '',
                    'email_content' => '',
                    'step_id' => $value->id,
                ];
            } else {
                $templates[] = [
                    'name' => 'Outbound Standard Email 1',
                    'pointer' => 'Hey would be great to connect with you, My name is X and I understand you are involved in ladidadiada.',
                    'email_subject' => '',
                    'email_content' => '',
                    'step_id' => $value->id,
                ];
            }
        }

        StepTemplate::insert($templates);
    }
}
