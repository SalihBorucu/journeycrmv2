<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncompleteLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomplete_leads', function (Blueprint $table) {
            $table->id();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->text('country')->nullable();
            $table->text('title')->nullable();
            $table->text('email')->nullable();
            $table->text('phone_1')->nullable();
            $table->text('phone_2')->nullable();
            $table->text('linkedin')->nullable();
            $table->unsignedBigInteger('user_id'); //createBy
            $table->boolean('unassigned');
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
        Schema::dropIfExists('incomplete_leads');
    }
}
