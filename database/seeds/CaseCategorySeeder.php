<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseCategory;
class CaseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CaseCategory::insert([
            [
                'name' => 'Criminal Cases',
                'description' => 'Criminal Cases. Criminal cases involve enforcing public codes of behavior, which are codified in the laws of the state'
            ],
            [
                'name' => 'Civil Cases',
                'description' => 'Civil Cases. Civil cases involve conflicts between people or institutions such as businesses, typically over money'
            ],
            [
                'name' => 'Family Cases',
                'description' => ''
            ],
        ]);

    }
}
