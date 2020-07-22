<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->text('first_name');
            $table->text('last_name');
            $table->unsignedBigInteger('company_id');
            $table->text('country');
            $table->text('title');
            $table->text('email');
            $table->text('phone_1');
            $table->text('phone_2')->nullable();
            $table->text('linkedin');
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
        Schema::dropIfExists('leads');
    }
}
