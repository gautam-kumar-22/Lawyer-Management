<?php

use Illuminate\Database\Seeder;
use Modules\Setting\Database\Seeders\ConfigTableSeeder;

use Database\Seeders\ContactCategorySeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ClientCategorySeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\CourtCategorySeeder;
use Database\Seeders\CourtSeeder;
use Database\Seeders\CaseActSeeder;
use Database\Seeders\StageSeeder;
use Database\Seeders\CaseCategorySeeder;
use Database\Seeders\LawyerSeeder;
use Database\Seeders\CaseSeeder;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\TaskSeeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
	
		// $this->call(ConfigTableSeeder::class);

		// contact
		$this->call(ContactCategorySeeder::class);
		$this->call(ContactSeeder::class);

		// Client
		$this->call(ClientCategorySeeder::class);
		$this->call(ClientSeeder::class);


		// court
		$this->call(CourtCategorySeeder::class);
		$this->call(CourtSeeder::class);

		// case 
		$this->call(CaseActSeeder::class);
		$this->call(StageSeeder::class);
		$this->call(CaseCategorySeeder::class);

		// lawyer
		$this->call(LawyerSeeder::class);

		// CaseSeeder
		$this->call(CaseSeeder::class);

		// Appointment Seeder
		$this->call(AppointmentSeeder::class);

		// Task
		$this->call(TaskSeeder::class);




	}
}
