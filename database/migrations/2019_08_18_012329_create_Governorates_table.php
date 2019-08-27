<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGovernoratesTable extends Migration {

	public function up()
	{
		Schema::create('Governorates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('governorate_name',255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Governorates');
	}
}