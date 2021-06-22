<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHearingDatesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hearing_dates', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('cases_id')->nullable()->unsigned();
			$table->foreign('cases_id')->references('id')
				->on('cases')->onDelete('cascade');

			$table->date('date')->nullable();
			$table->longText('description')->nullable();
			$table->string('status')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('hearing_dates');
	}
}
