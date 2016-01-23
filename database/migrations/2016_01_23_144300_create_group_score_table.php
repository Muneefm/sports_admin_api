<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupScoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('score', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('b');
            $table->string('g');
            $table->string('r');
            $table->string('y');
            $table->timestamps();
        });
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('score');

    }

}
