<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\LeaveApprovedMail;
use Mail;
class LeaveApprovedMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $creator, $leave;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $creator, $leave)
    {
        $this->user = $user;
        $this->creator = $creator;
        $this->leave = $leave;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new LeaveApprovedMail($this->user, $this->creator, $this->leave));
    }
}
