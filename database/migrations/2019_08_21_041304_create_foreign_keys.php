<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('posts', function(Blueprint $table) {
			$table->foreign('thumbnail_id')->references('id')->on('thumbnails')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('Blood_types')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('donation_id')->references('id')->on('donations')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
	

		Schema::table('favourites', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('Posts')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('favourites', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('clientables', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('restrict');
		});

		Schema::table('posts', function (Blueprint $table) {
            
            $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');
		});
		
		Schema::table('clients', function (Blueprint $table) {

				$table->foreign('blood_type_id')->references('id')->on('blood_types');
				
		});
		
		Schema::table('donations', function (Blueprint $table) {

			$table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
			
		});
		
		Schema::table('client_notification', function(Blueprint $table) { 
			$table->foreign('notification_id')->references('id')->on('notifications')
						->onDelete('cascade');
						

			
		});

		Schema::table('client_notification', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('restrict');
		});

		Schema::table('tokens', function(Blueprint $table) { 
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

			
		});

		Schema::table('donations', function(Blueprint $table) { 
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

			
		});
	}

	public function down()
	{
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_city_id_foreign');
		});
		Schema::table('Cites', function(Blueprint $table) {
			$table->dropForeign('cites_Governorate_id_foreign');
		});
		Schema::table('Posts', function(Blueprint $table) {
			$table->dropForeign('posts_thumbnail_id_foreign');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_blood_type_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_donation_id_foreign');
		});
	
		Schema::table('Favourites', function(Blueprint $table) {
			$table->dropForeign('Favourites_post_id_foreign');
		});
		Schema::table('Favourites', function(Blueprint $table) {
			$table->dropForeign('Favourites_client_id_foreign');
		});
		Schema::table('clientables', function(Blueprint $table) {
			$table->dropForeign('clientables_client_id_foreign');
		});

		Schema::table('posts', function(Blueprint $table) {
			$table->dropForeign('catagory_id');
		});

		Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('blood_type_id');
		});
		
		Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign('governorate_id');
		});
		
		Schema::table('client_notification', function(Blueprint $table) {
			$table->dropForeign('client_notification_client_id_foreign');
		});
		
		Schema::table('client_notification', function(Blueprint $table) {
			$table->dropForeign('client_notification_notification_id_foreign');
		});

		Schema::table('tokens', function(Blueprint $table) {
			$table->dropForeign('tokens_client_id_foreign');
		});

		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_client_id_foreign');
		});

	}
}