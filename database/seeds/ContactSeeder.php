<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::insert(

            [
            [
                "contact_category_id" => 4,
                "name" => "Liza",
                "mobile_no" => "+62 604 204 5795",
                "email" => "laloshechkin0@hhs.gov",
                "description" => "Revision of Radioactive Element in Head, Perc Endo Approach"
              ], [
                "contact_category_id" => 5,
                "name" => "Randi",
                "mobile_no" => "+86 325 752 9714",
                "email" => "rgansbuhler1@altervista.org",
                "description" => "Replacement of L Up Femur with Autol Sub, Open Approach"
              ], [
                "contact_category_id" => 3,
                "name" => "Sacha",
                "mobile_no" => "+51 744 817 9445",
                "email" => "stebbe2@plala.or.jp",
                "description" => "Removal of Synth Sub from Low Tendon, Perc Endo Approach"
              ], [
                "contact_category_id" => 2,
                "name" => "Tabitha",
                "mobile_no" => "+33 221 852 8164",
                "email" => "tvarty3@github.io",
                "description" => "Division of Left Metatarsal, Percutaneous Approach"
              ], [
                "contact_category_id" => 2,
                "name" => "Hulda",
                "mobile_no" => "+46 767 556 0828",
                "email" => "heyckelberg4@addthis.com",
                "description" => "Bypass R Pleural Cav to Pelvic Cav w Synth Sub, Open"
              ], [
                "contact_category_id" => 1,
                "name" => "Violante",
                "mobile_no" => "+1 637 157 5869",
                "email" => "vhatje5@craigslist.org",
                "description" => "Extraction of Left Vocal Cord, Percutaneous Approach"
              ], [
                "contact_category_id" => 5,
                "name" => "Loise",
                "mobile_no" => "+39 452 779 3943",
                "email" => "lstillgoe6@spotify.com",
                "description" => "Reposition Left Mandible, Percutaneous Approach"
              ], [
                "contact_category_id" => 3,
                "name" => "Jarrod",
                "mobile_no" => "+976 659 724 4220",
                "email" => "jkimm7@state.gov",
                "description" => "Release Scalp Subcu/Fascia, Extern Approach"
              ], [
                "contact_category_id" => 4,
                "name" => "Cassy",
                "mobile_no" => "+234 357 258 2185",
                "email" => "cbraden8@w3.org",
                "description" => "Inspection of Larynx, Open Approach"
              ], [
                "contact_category_id" => 1,
                "name" => "Corella",
                "mobile_no" => "+86 820 619 2850",
                "email" => "clusty9@telegraph.co.uk",
                "description" => "Supplement Rectum with Nonautologous Tissue Substitute, Endo"
              ], [
                "contact_category_id" => 5,
                "name" => "Sosanna",
                "mobile_no" => "+234 111 823 6959",
                "email" => "sbrosioa@people.com.cn",
                "description" => "Removal of Monitor Dev from Diaphragm, Perc Endo Approach"
              ], [
                "contact_category_id" => 1,
                "name" => "Minne",
                "mobile_no" => "+34 607 320 0670",
                "email" => "mskilbeckb@blogs.com",
                "description" => "Extraction of Nasal Septum, Open Approach"
              ], [
                "contact_category_id" => 2,
                "name" => "Terese",
                "mobile_no" => "+63 403 125 8869",
                "email" => "tpelcheurc@weibo.com",
                "description" => "Ventil, Resp/Circ Assess Circ Body w Mech Equip"
              ], [
                "contact_category_id" => 5,
                "name" => "Riane",
                "mobile_no" => "+358 320 109 2815",
                "email" => "reasund@goodreads.com",
                "description" => "Ultrasonography of Left Subclavian Artery"
              ], [
                "contact_category_id" => 4,
                "name" => "Fletch",
                "mobile_no" => "+62 974 869 3066",
                "email" => "fwardinglye@seattletimes.com",
                "description" => "Repair Facial Nerve, Percutaneous Approach"
              ], [
                "contact_category_id" => 5,
                "name" => "Monro",
                "mobile_no" => "+86 259 500 6888",
                "email" => "mcostellof@nydailynews.com",
                "description" => "Repair Left 4th Toe, Percutaneous Endoscopic Approach"
              ], [
                "contact_category_id" => 5,
                "name" => "Hunfredo",
                "mobile_no" => "+691 761 230 3726",
                "email" => "hclaypooleg@zdnet.com",
                "description" => "Bypass Esophageal Vein to Low Vein w Nonaut Sub, Perc Endo"
              ], [
                "contact_category_id" => 3,
                "name" => "Duncan",
                "mobile_no" => "+234 796 343 7114",
                "email" => "dcobonh@soundcloud.com",
                "description" => "Insert Intralum Dev in R Less Saphenous, Perc Endo"
              ], [
                "contact_category_id" => 1,
                "name" => "Jermaine",
                "mobile_no" => "+62 459 135 4495",
                "email" => "jchauncei@senate.gov",
                "description" => "Excision of Left Hip Tendon, Open Approach"
              ], [
                "contact_category_id" => 4,
                "name" => "Beatrice",
                "mobile_no" => "+7 453 644 8169",
                "email" => "bfernaoj@youku.com",
                "description" => "Bypass Esophageal Vein to Lower Vein, Open Approach"
              ]]

        );
    }
}
