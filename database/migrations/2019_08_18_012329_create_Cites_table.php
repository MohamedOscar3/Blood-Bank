<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecitesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->string('city_name', 255);
			$table->integer('governorate_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Cites');
	}
}