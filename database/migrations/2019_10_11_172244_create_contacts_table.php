<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('contacts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('contact_category_id')->nullable()->unsigned();
			$table->foreign('contact_category_id')->references('id')
				->on('contact_categories')->onDelete('cascade');
			$table->string('name')->nullable();
			$table->string('mobile_no')->nullable();
			$table->string('email')->nullable();
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
		Schema::dropIfExists('contacts');
	}
}
