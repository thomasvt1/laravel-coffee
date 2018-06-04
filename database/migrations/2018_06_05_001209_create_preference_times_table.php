<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenceTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preference_id');
            $table->foreign('preference_id')->references('id')->on('preferences');
            $table->text('days');
            $table->text('start_time');
            $table->text('end_time');
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
        Schema::dropIfExists('preference_times');
    }
}
