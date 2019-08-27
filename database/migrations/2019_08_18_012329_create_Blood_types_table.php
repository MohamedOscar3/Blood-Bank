<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('Blood_types', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('type_name', 100);
		});
	}

	public function down()
	{
		Schema::drop('Blood_types');
	}
}