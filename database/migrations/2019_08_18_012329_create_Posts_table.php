<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('Posts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->integer('thumbnail_id')->unsigned();
			$table->text('Content');
			$table->integer('catagory_id')->index()->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Posts');
	}
}