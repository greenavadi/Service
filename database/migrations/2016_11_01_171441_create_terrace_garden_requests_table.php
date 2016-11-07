<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerraceGardenRequestsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('terrace_garden_requests', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('terrace_garden_requests');
    }

}
