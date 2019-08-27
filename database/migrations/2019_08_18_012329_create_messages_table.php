<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255);
			$table->integer('phone_number')->unsigned();
			$table->string('title', 255);
			$table->text('content');
			$table->unsignedInteger('client_id')->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('messages');
	}
}