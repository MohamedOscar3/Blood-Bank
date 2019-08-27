<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotficationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->integer('donation_id')->unsigned();
			$table->text('content');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}