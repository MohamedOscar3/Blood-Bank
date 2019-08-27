<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigsTable extends Migration {

	public function up()
	{
		Schema::create('configs', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('Phone_number')->unsigned();
			$table->string('Email', 255);
			$table->string('Fb', 255);
			$table->string('tw', 255);
			$table->string('insta', 255);
			$table->string('whats', 255);
			$table->string('youtube', 255);
			$table->string('gplus', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Configs');
	}
}