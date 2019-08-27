<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientablesTable extends Migration {

	public function up()
	{
		Schema::create('clientables', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('client_id')->unsigned();
			$table->string('clientables_type', 255);
			$table->integer('clientables_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}