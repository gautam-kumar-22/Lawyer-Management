<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Stage::insert([
            [
                'name' => 'File The Complaint‎'
            ],
            [
                'name' => 'Begin The Discovery'
                
            ],
            [
                'name' => 'Go To Trial'
            ],
            [
                'name' => 'Jury Instruction‎'
                
            ],
            [
                'name' => 'Closing Arguments‎'
            ]
        ]);
    }
}
