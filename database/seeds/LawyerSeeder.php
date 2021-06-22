<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Lawyer::insert([
        [
            "mobile_no" => "Zaragoza",
            "description" => "Reposition Left Fibula with Hybrid Ext Fix, Open Approach",
            "name" => "Vickie Epps"
          ], [
            "mobile_no" => "Tsaghveri",
            "description" => "Change Other Device in Vas Deferens, External Approach",
            "name" => "Quill Ortega"
          ], [
            "mobile_no" => "Valencia",
            "description" => "Replacement of R Maxilla with Nonaut Sub, Perc Endo Approach",
            "name" => "Lovell Linthead"
          ], [
            "mobile_no" => "Blyznyuky",
            "description" => "Extirpation of Matter from Left Mandible, Perc Endo Approach",
            "name" => "Berri de Guerre"
          ], [
            "mobile_no" => "Rucheng Chengguanzhen",
            "description" => "Insertion of Pressure Sens into R Pulm Vein, Open Approach",
            "name" => "Alexandr Aleksandrov"
          ], [
            "mobile_no" => "Yasugichō",
            "description" => "Drainage of Left Extraocular Muscle, Open Approach",
            "name" => "Maximilian Barrs"
          ], [
            "mobile_no" => "Zavolzh’ye",
            "description" => "Upper Bones, Excision",
            "name" => "Minda Fivey"
          ], [
            "mobile_no" => "Čejkovice",
            "description" => "Release Accessory Nerve, Percutaneous Endoscopic Approach",
            "name" => "Lennie Abbay"
          ], [
            "mobile_no" => "Magoúla",
            "description" => "Removal of Int Fix from Thor Jt, Open Approach",
            "name" => "Jere Collins"
          ], [
            "mobile_no" => "Quebrada de Arena",
            "description" => "Supplement Splenic Artery with Synth Sub, Perc Approach",
            "name" => "Nat Pullin"
          ], [
            "mobile_no" => "Nahrīn",
            "description" => "Division of Scalp Skin, External Approach",
            "name" => "Darren McParland"
          ], [
            "mobile_no" => "Rosario de Lerma",
            "description" => "Drainage of Left Lower Eyelid, External Approach",
            "name" => "Codie Duck"
        ]]);
    }
}
