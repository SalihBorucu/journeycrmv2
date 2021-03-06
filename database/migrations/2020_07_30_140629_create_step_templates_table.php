<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_templates', function (Blueprint $table) {
            $table->id();
            $table->text('pointer')->nullable();
            $table->text('name');
            $table->text('email_subject')->nullable();
            $table->text('email_content')->nullable();
            $table->unsignedBigInteger('step_id');
            $table->timestamps();

            $table->foreign('step_id')
                ->references('id')
                ->on('steps')
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
        Schema::dropIfExists('step_templates');
    }
}
