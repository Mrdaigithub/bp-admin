<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('uid');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('ip')->default('0.0.0.0');
            $table->boolean('power')->default(false);
            $table->timestamp('expired_date');
            $table->timestamps();
        });

        Schema::create('user_config', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('config_id')->unsigned();
        });

        Schema::create('user_ad', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('ad_id')->unsigned();
        });

        Schema::create('user_log', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('log_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
