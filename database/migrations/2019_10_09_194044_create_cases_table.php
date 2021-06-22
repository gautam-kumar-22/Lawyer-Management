<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cases', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string('title');
			$table->string('case_no')->nullable();
			$table->string('file_no')->nullable();
			$table->string('ref_name')->nullable();
			$table->string('ref_mobile')->nullable();

			$table->bigInteger('plaintiff')->nullable()->unsigned();
			$table->foreign('plaintiff')->references('id')
				->on('clients')->onDelete('SET NULL');

			$table->bigInteger('opposite')->nullable()->unsigned();
			$table->foreign('opposite')->references('id')
				->on('clients')->onDelete('SET NULL');

			$table->bigInteger('client_category_id')->nullable()->unsigned();
			$table->foreign('client_category_id')->references('id')
				->on('client_categories')->onDelete('SET NULL');

			$table->bigInteger('stage_id')->nullable()->unsigned();
			$table->foreign('stage_id')->references('id')
				->on('stages')->onDelete('SET NULL');

			$table->bigInteger('case_category_id')->nullable()->unsigned();
			$table->foreign('case_category_id')->references('id')
				->on('case_categories')->onDelete('SET NULL');

			$table->bigInteger('lawyer_id')->nullable()->unsigned();
			$table->foreign('lawyer_id')->references('id')
				->on('lawyers')->onDelete('SET NULL');

			$table->bigInteger('court_id')->nullable()->unsigned();
			$table->foreign('court_id')->references('id')
				->on('courts')->onDelete('SET NULL');

			$table->bigInteger('court_category_id')->nullable()->unsigned();
			$table->foreign('court_category_id')->references('id')
				->on('court_categories')->onDelete('SET NULL');

			$table->enum('client', ['Plaintiff', 'Opposite'])->default('Plaintiff');

			$table->date('receiving_date')->nullable();
			$table->date('filling_date')->nullable();
			$table->date('hearing_date')->nullable();
			$table->date('judgement_date')->nullable();

			$table->longText('description')->nullable();
			$table->longText('judgement')->nullable();
			$table->string('judgement_status', 50)->default('Open');
			$table->enum('status', ['Open', 'Judgement','Close','Reopen'])->default('Open');

			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('cases');
	}
}
