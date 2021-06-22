<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AppointmentMail;
use Mail;

class AppointmentMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $contact, $appointment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact, $appointment)
    {
        $this->contact = $contact;
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(config('configs')->where('key', 'email')->first()->value)->send(new AppointmentMail($this->contact, $this->appointment));
    }
}
