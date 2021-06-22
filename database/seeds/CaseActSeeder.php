<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Act;
class CaseActSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Act::insert([
            [
                'name' => '56',
                'description' => ' Sub-clause (e) was omitted by section 6(2) of the Bengal, Agra and Assam Civil Courts (Bengal Amendment) Act, 1935.
                '
            ],
            [
                'name' => '67',
                'description' => 'The words “Senior Assistant Judge or Assistant Judge” were substituted, for the words “Assistant Judge” by sections 14, 15 and 16 of the Civil Courts (Amendment) Act, 2001 (Act No. XLIX of 2001)'
            ],
            [
                'name' => '57',
                'description' => 'The words “Joint District” were substituted, for the word “Subordinate” by sections 14, 15 and 16 of the Civil Courts (Amendment) Act, 2001 (Act No. XLIX of 2001'
            ],
        ]);
    }
}
