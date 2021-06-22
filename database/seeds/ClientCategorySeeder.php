<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientCategory;
class ClientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientCategory::insert([
            [
                'name' => 'VIP Client',
                'plaintiff' => 1
            ],
            [
                'name' => 'Company Client',
                'plaintiff' => 1
            ],
            [
                'name' => 'Habitual Client',
                'plaintiff' => 1
            ]
        ]);
    }
}
