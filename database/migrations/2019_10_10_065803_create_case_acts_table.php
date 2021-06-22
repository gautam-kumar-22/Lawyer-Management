<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseActsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('case_acts', function (Blueprint $table) {
			$table->bigInteger('cases_id')->nullable()->unsigned();
			$table->foreign('cases_id')->references('id')
				->on('cases')->onDelete('cascade');

			$table->bigInteger('acts_id')->nullable()->unsigned();
			$table->foreign('acts_id')->references('id')
				->on('acts')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('case_acts');
	}
}
