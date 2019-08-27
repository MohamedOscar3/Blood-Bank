<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255)->unique();
			$table->date('date_of_birth');
			$table->date('last_date_of_donation')->nullable();
			$table->integer('city_id')->unsigned()->index();
			$table->integer('blood_type_id')->unsigned()->index();
			$table->string('phone_number')->unique();
			$table->string('password', 255);
			$table->string('api_token', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}