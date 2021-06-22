<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::insert([

           [
            "title" => "Sm bowel stoma revision",
            "motive" => "Mechanical complication of vascular dialysis catheter",
            "contact_id" => 8,
            "notes" => "Revision of stoma of small intestine",
            "date" => "2020-11-08"
          ], [
            "title" => "Simple mastoidectomy",
            "motive" => "Chronic multifocal osteomyelitis, right femur",
            "contact_id" => 4,
            "notes" => "Simple mastoidectomy",
            "date" => "2020-04-09"
          ],
          [
            "title" => "Client appointment",
            "motive" => "Discuss about client case",
            "contact_id" => 3,
            "notes" => "Other forcible correction of musculoskeletal deformity",
            "date" => "2020-10-18"
          ], [
            "title" => "VIP Clitent appointment",
            "motive" => "Discuss about vip client case",
            "contact_id" => 7,
            "notes" => "Other fixation of small intestine",
            "date" => "2021-01-13"
          ], [
            "title" => "Judge appointment",
            "motive" => "Monoplg low lmb fol ntrm intcrbl hemor aff right dom side",
            "contact_id" => 3,
            "notes" => "Vectorcardiogram (with ECG)",
            "date" => "2020-05-27"
          ], [
            "title" => "New Client Appontment",
            "motive" => "Acute ethmoidal sinusitis, unspecified",
            "contact_id" => 7,
            "notes" => "Operations on trabeculae carneae cordis",
            "date" => "2020-02-26"
          ]
        ]
        );
    }
}
