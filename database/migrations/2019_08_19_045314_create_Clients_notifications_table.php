<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('client_notification', function(Blueprint $table) {

			$table->increments('id');
			$table->unsignedInteger('client_id')->index();
			$table->unsignedInteger('notification_id')->index();
			$table->unsignedInteger('read_statue')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{

		Schema::drop('client_notification');

	}
}