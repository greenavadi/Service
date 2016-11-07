<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplingRequestsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sampling_requests', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('sampling_id');
            $table->integer('no_of_samples');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sampling_id')->references('id')->on('samplings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sampling_requests');
    }

}
