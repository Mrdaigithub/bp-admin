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
            $table->increments('id');
            $table->string('adtype')->nullable()->default('default');
            $table->string('keyds')->nullable()->default('');
            $table->string('nokeyds')->nullable()->default('');
            $table->string('title')->nullable()->default('');
            $table->string('depict')->nullable()->default('');
            $table->string('link')->nullable()->default('');
            $table->string('xslink')->nullable()->default('');
            $table->string('bshow')->nullable()->default('');
            $table->string('brandlogo')->nullable()->default('');
            $table->string('brand_title1')->nullable()->default('');
            $table->string('brand_lnke1')->nullable()->default('');
            $table->string('brand_title2')->nullable()->default('');
            $table->string('brand_lnke2')->nullable()->default('');
            $table->string('telephone')->nullable()->default('');
            $table->string('adimgurl_1')->nullable()->default('');
            $table->string('adimglink_1')->nullable()->default('');
            $table->string('adimgurl_2')->nullable()->default('');
            $table->string('adimglink_2')->nullable()->default('');
            $table->string('adimgurl_3')->nullable()->default('');
            $table->string('adimglink_3')->nullable()->default('');
            $table->string('adimgurl_4')->nullable()->default('');
            $table->string('adimglink_4')->nullable()->default('');
            $table->string('dtname')->nullable()->default('');
            $table->string('docposition')->nullable()->default('');
            $table->string('dtpic')->nullable()->default('');
            $table->string('custom_code')->nullable()->default('');
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
