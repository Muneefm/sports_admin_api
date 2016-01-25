<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupBlue extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('blueg', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('year');
            $table->string('class');
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
        Schema::drop('blueg');

    }

}
