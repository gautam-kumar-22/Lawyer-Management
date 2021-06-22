<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class LeaveApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tamplate = EmailTemplate::where('type', 'leave_approve')->first();

        $subject= $tamplate->subject;
        $body = $tamplate->value;
        
        $key = ['{USER_NAME}','{LEAVE_REASONE}','{APPROVED_BY}','{START_DATE}','{END_DATE}','{EMAIL_SIGNATURE}'];
        $value = [$this->user->name,$this->leave->reason, $this->creator->name,
        formatDate($this->leave->start_date),formatDate($this->leave->end_date),config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
