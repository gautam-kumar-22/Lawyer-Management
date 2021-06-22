<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactCategory;
class ContactCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactCategory::insert([
            [
                'name' => 'Judge'
            ],
            [
                'name' => 'Lawyer'
            ],
            [
                'name' => 'Client'
            ],
            [
                'name' => 'Court reporter'
            ],
            [
                'name' => 'Clerks'
            ]
        ]);

    }
}
