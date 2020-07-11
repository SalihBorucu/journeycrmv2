<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('step_id');
            $table->unsignedBigInteger('previous_step_number')->nullable();
            $table->unsignedBigInteger('previous_schedule_id')->nullable();
            $table->text('current_status');
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('lead_id')
                ->references('id')
                ->on('leads')
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
        Schema::dropIfExists('lead_accounts');
    }
}
