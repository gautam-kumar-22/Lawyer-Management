<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Task\Entities\Task;
use Carbon\Carbon;
use App\Jobs\DateRemainderMailJob;
class DateReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:due-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('status', 0)->get();
        

        foreach($tasks as $task)
        {
            $oneDay = Carbon::today()->add(1,'day');

            $endDate = Carbon::parse($task->due_date);
            if($oneDay == $endDate)
            {
                dispatch(new DateRemainderMailJob($task));
            }
        }

    }
}
