<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Court::insert([[
            "court_category_id" => 1,
            "name" => "Dhaka Suprim Court",
            "description" => "Revision of Spacer in R Toe Phalanx Jt, Perc Endo Approach",
            "location" => "3161 Everett Circle",
            "room_number" => 207,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
          ], [
            "court_category_id" => 4,
            "name" => "Dhaka Judge Court",
            "description" => "Removal of Synthetic Substitute from Up Back, Perc Approach",
            "location" => "19176 Hallows Center",
            "room_number" => 205,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
          ], [
            "court_category_id" => 4,
            "name" => "CTG Court",
            "description" => "Extirpation of Matter from Right Radius, Open Approach",
            "location" => "4 Oak Valley Way",
            "room_number" => 206,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
          ], [
            "court_category_id" => 2,
            "name" => "New York Court",
            "description" => "Dilation of Left Ureter with Intralum Dev, Perc Approach",
            "location" => "67028 Kedzie Plaza",
            "room_number" => 202,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
            
          ], [
            "court_category_id" => 1,
            "name" => "Alabama Court",
            "description" => "Removal of Autol Sub from Epididymis/Sperm Cord, Endo",
            "location" => "922 Pine View Plaza",
            "room_number" => 203,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
          ], [
            "court_category_id" => 2,
            "name" => "Feni Court",
            "description" => "Bypass R Subclav Art to Bi Low Leg Art w Nonaut Sub, Open",
            "location" => "46 Wayridge Alley",
            "room_number" => 209,
            'country_id' => 231,
                'state_id' => 3921,
                'city_id' => 42709
        ]]
        );
    }
}
