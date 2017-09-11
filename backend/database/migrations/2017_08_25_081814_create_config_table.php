<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('hospital')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('domainname')->nullable();
            $table->text('swturl')->nullable();
            $table->string('opentime')->nullable()->default('00:00:00-23:59:59');
            $table->text('area')->nullable();
            $table->string('piaoimg')->nullable();
            $table->string('piaourl')->nullable();
            $table->text('ipduan')->nullable();
            $table->text('cith')->nullable();
            $table->string('mobilecode')->nullable();
            $table->string('daima')->nullable();
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
        Schema::drop('configs');
    }

}
