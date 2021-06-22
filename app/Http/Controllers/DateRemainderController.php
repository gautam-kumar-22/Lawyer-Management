<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Task\Entities\Task;
use Carbon\Carbon;
use App\Jobs\DateRemainderMailJob;
class DateRemainderController extends Controller
{
    public function dueDate()
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
