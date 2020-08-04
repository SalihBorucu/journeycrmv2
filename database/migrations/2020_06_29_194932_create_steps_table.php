<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_schedule_id')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->integer('step_number');
            $table->text('type')->nullable();
            $table->integer('day_gap')->nullable();

            $table->timestamps();

            $table->foreign('campaign_schedule_id')
                ->references('id')
                ->on('campaign_schedules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steps');
    }
}
