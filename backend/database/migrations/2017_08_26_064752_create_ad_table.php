<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('type')->nullable()->default('default');
            $table->string('title')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->string('picture')->nullable()->default('');
            $table->string('link')->nullable()->default('');
            $table->string('show_link')->nullable()->default('');
            $table->string('brand_link')->nullable()->default('');
            $table->string('brand_title1')->nullable()->default('');
            $table->string('brand_description1')->nullable()->default('');
            $table->string('brand_title2')->nullable()->default('');
            $table->string('brand_description2')->nullable()->default('');
            $table->string('doctor_name')->nullable()->default('');
            $table->string('doctor_job')->nullable()->default('');
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
        Schema::drop('ads');
    }

}
