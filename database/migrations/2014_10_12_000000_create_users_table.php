<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {


		
		Schema::create('users', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
			$table->unsignedBigInteger('role_id');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(TRUE);
            $table->string('language')->nullable();
            $table->tinyInteger('ttl_rtl')->nullable();
			$table->string('status', 25)->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
			$table->timestamps();
		});
        
		
			User::create([
				'name' => 'Admin',
				'username' => 'admin',
				'email' => 'admin@gmail.com',
				'role_id' => 1,
				'email_verified_at' => '2020-09-09 16:52:36',
				'password' => Hash::make(12345678),
				'status' => 'activated'
			]);
		if(Illuminate\Support\Facades\Config::get('app.app_sync')){
			User::create([
				'name' => 'Lawyer',
				'username' => 'lawyer',
				'email' => 'lawyer@gmail.com',
				'role_id' => 2,
				'email_verified_at' => '2020-09-09 16:52:36',
				'password' => Hash::make(12345678),
				'status' => 'activated'
			]);
		 }
		


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
