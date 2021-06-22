<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('courts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('location')->nullable();
			$table->string('room_number')->nullable();

			$table->unsignedBigInteger('country_id')->nullable();
			$table->foreign('country_id')->references('id')
				->on('countries')->onDelete('SET NULL');

			$table->unsignedBigInteger('state_id')->nullable()->unsigned();
			$table->foreign('state_id')->references('id')
				->on('states')->onDelete('SET NULL');

			$table->unsignedBigInteger('city_id')->nullable()->unsigned();
			$table->foreign('city_id')->references('id')
				->on('cities')->onDelete('SET NULL');

			$table->unsignedBigInteger('court_category_id')->nullable()->unsigned();
			// $table->foreign('court_category_id')->references('id')
			// 	->on('court_categories')->onDelete('SET NULL');

			$table->longText('description')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('courts');
	}
}
