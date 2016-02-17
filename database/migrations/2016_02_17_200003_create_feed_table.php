<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('feeds', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('mainstring');
            $table->string('image')->nullable();
            $table->string('imagepath')->nullable();
            $table->string('ext')->nullable();
            $table->string('author')->nullable();
            $table->string('substring')->nullable();


            //  $table->string('y');
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
        Schema::drop('feeds');

    }

}
