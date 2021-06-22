<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatgeIdToHearingDatesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('hearing_dates', function (Blueprint $table) {

			$table->bigInteger('stage_id')->nullable()->unsigned();
			$table->foreign('stage_id')->references('id')
				->on('stages')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('hearing_dates', function (Blueprint $table) {
			//
		});
	}
}
