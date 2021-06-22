<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TaskAssigneeMail;
use Mail;
class TaskAssigneeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $assigneFrom, $task,$case, $assigneTo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($assigneFrom, $task,$case, $assigneTo)
    {
        $this->assigneFrom = $assigneFrom;
        $this->task = $task;
        $this->case = $case;
        $this->assigneTo = $assigneTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->assigneTo->email)->send(new TaskAssigneeMail($this->assigneFrom, $this->task,$this->case, $this->assigneTo));
    }
}
