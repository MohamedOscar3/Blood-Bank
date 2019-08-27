<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationsTable extends Migration {

	public function up()
	{
		Schema::create('donations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->smallInteger('age')->unsigned()->index();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('number_of_blood_cysts')->unsigned();
			$table->integer('governorate_id')->unsigned()->index();
			$table->integer('client_id')->unsigned()->index();
			$table->string('hospital_name', 255);
			$table->double('lat');
			$table->double('Ing');
			$table->integer('phone_number')->unsigned();
			$table->text('notes')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donations');
	}
}