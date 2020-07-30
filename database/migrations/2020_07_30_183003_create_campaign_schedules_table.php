<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_schedules');
    }
}

//every campaign has to have qualified, interested, email only,
//email template belongs to step 1 of outbound schedule of outbound campaign from Xaccount
//account has one template for step 1 of schedule of xcampaign
//accountX:            campaign -outbound -inbound -event -custom
//outbound campaign:   schedule -prospecting -qualified -interested -email_only
//interested schedule: step -step1 -step2 -step3 etc.
//step1 step:          template content, name ladida...

//steps-hasOne template

//schedules-hasMany steps |(no pivot) account_id, campaign_id, schedule_id

//campaigns-hasMany schedules --pivot account_id, campaign_id, schedule_id
//accounts-hasMany campaigns account_id, campaign_id


/*
50
120*25
5, 5, 25

125


schedule - 20 steps

email, social, call
*/
