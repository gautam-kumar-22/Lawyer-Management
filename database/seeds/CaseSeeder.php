<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caseSql = "INSERT INTO `cases` (`id`, `title`, `case_no`, `file_no`, `ref_name`, `ref_mobile`, `plaintiff`, `opposite`, `client_category_id`, `stage_id`, `case_category_id`, `lawyer_id`, `court_id`, `court_category_id`, `client`, `receiving_date`, `filling_date`, `hearing_date`, `judgement_date`, `description`, `judgement`, `judgement_status`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Jerrine v/s Sissie', '01', '11', 'Jakeem Walls', '0994849834', 1, 2, 1, 3, 1, 1, 1, 1, 'Plaintiff', NULL, '2021-02-17', '2021-02-17', NULL, 'This is description for case 1.', NULL, 'Open', 'Open', '2021-02-17 05:22:06', '2021-02-17 05:22:06'),
        (2, 'Lynelle v/s Tyrus', '02', '21', 'Ldola Burgess', '0948348943', 3, 4, 2, 1, 2, 4, 2, 2, 'Plaintiff', NULL, '2021-02-17', '2021-02-19', NULL, 'Ex irure minima mole. This is for case 2.', NULL, 'Open', 'Open', '2021-02-17 05:24:26', '2021-02-17 05:24:26'),
        (3, 'Ania v/s Shaughn', '03', '31', 'Nadine Daniels', '09489894398', 5, 6, 3, 2, 3, 12, 4, 4, 'Plaintiff', '2021-02-16', '2021-02-19', '2021-02-17', NULL, 'This is a case description for the case 3.', NULL, 'Open', 'Open', '2021-02-17 05:27:29', '2021-02-17 05:28:41')";

        $caseActSql = "INSERT INTO `case_acts` (`cases_id`, `acts_id`) VALUES
        (1, 1),
        (1, 2),
        (2, 1),
        (2, 2),
        (3, 2)";

        $dateSql = "INSERT INTO `hearing_dates` (`id`, `cases_id`, `date`, `description`, `status`, `created_at`, `updated_at`, `stage_id`, `type`) VALUES
        (1, 1, '2021-02-17', 'This is description for case 1.', NULL, '2021-02-17 05:22:06', '2021-02-17 05:22:06', 3, 'hearing_dates'),
        (2, 2, '2021-02-19', 'Ex irure minima mole. This is for case 2.', NULL, '2021-02-17 05:24:26', '2021-02-17 05:24:26', 1, 'hearing_dates'),
        (3, 3, '2021-02-17', '<p>This for case 3, this is description.</p>', NULL, '2021-02-17 05:28:41', '2021-02-17 05:28:41', 2, 'hearing_dates'),
        (4, 1, '2021-02-20', '<p>Staty with&nbsp;suspect at court.&nbsp;</p><p>Time : 10 AM.</p>', NULL, '2021-02-17 05:38:06', '2021-02-17 05:38:06', NULL, 'putlist'),
        (5, 2, '2021-03-01', '<p>Sent a lawyer in date.</p><p>Time : 3:00 PM</p>', NULL, '2021-02-17 05:39:49', '2021-02-17 05:39:49', NULL, 'lobbying'),
        (6, 3, '2021-02-27', '<p>Sent a lawyer in date.</p><p>Time : 3:00 PM</p>', NULL, '2021-02-17 05:40:14', '2021-02-17 05:40:14', NULL, 'lobbying'),
        (7, 3, '2021-02-17', '<p>Sent a lawyer in date with suspect.</p><p>Time : 3:00 PM</p>', NULL, '2021-02-17 05:40:39', '2021-02-17 05:40:39', NULL, 'putlist'),
        (8, 1, '2021-02-27', '<p>Sent a lawyer in date.</p><p>Time : 3:00 PM</p>', NULL, '2021-02-17 05:40:50', '2021-02-17 05:40:50', NULL, 'lobbying'),
        (9, 2, '2021-02-26', '<p>Sent a lawyer in date with the suspect at court.</p><p>Time : 3:00 PM</p>', NULL, '2021-02-17 05:41:48', '2021-02-17 05:41:48', NULL, 'putlist')";

        DB::statement($caseSql);
        DB::statement($caseActSql);
        DB::statement($dateSql);
    }
}
