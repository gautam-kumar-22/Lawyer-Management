<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskSql = "INSERT INTO `tasks` (`id`, `assignee_id`, `created_by`, `case_id`, `stage_id`, `name`, `due_date`, `priority`, `description`, `progress`, `status`, `created_at`, `updated_at`) VALUES
        (1, 2, 1, 1, NULL, 'Create Report About This case', '2021-02-22', 'High', '<p>Create Report About This case urjent.<br></p>', NULL, 0, '2021-02-17 06:42:24', '2021-02-17 06:42:24'),
        (2, 2, 1, 2, 2, 'Find out the evidence about this case.', '2021-02-25', 'Medium', '<p>Find out the evidence about this case.<br></p>', NULL, 0, '2021-02-17 06:43:50', '2021-02-17 06:43:50'),
        (3, 2, 1, 3, 4, 'Collect the evidence and submit to court.', '2021-03-06', 'Low', NULL, NULL, 1, '2021-02-17 06:45:27', '2021-02-17 06:45:49')";

        DB::statement($taskSql);
    }

}
