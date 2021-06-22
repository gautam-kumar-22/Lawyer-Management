<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourtCategory;
class CourtCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourtCategory::insert([
            [
                'name' => 'Administrative courts‎'
            ],
            [
                'name' => 'Civil Court'
                
            ],
            [
                'name' => 'Family Court'
            ],
            [
                'name' => 'Juvenile courts‎'
                
            ],
            [
                'name' => 'Courts of equity‎'
            ]
        ]);
    }
}
