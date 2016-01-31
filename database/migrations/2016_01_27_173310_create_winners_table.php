<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('winners', function(Blueprint $table)
        {   
            $table->increments('id');
            $table->string('name');
            $table->string('event');
            $table->string('group');
            $table->string('pos');
            $table->string('year')->nullable();
            $table->string('class')->nullable();

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
        Schema::drop('winners');

    }


}
