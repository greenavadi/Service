<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('app_users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email_address', 128);
            $table->string('password', 128);
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('address', 512);
            $table->string('phone_number', 20);
            $table->string('reference', 250);
            $table->boolean('volunteer')->default(0);
            $table->boolean('admin')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('auth_token', 256)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('app_users');
    }

}
