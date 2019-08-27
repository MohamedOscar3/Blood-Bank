<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThumbnailsTable extends Migration {

	public function up()
	{
		Schema::create('thumbnails', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image_name', 255);
			$table->string('alt',255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('thumbnails');
	}
}