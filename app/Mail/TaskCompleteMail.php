<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class TaskCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tamplate = EmailTemplate::where('type', 'task_complete')->first();

        $subject= $tamplate->subject;
        $body = $tamplate->value;
        
        $key = ['{ASSIGNED_FROM}','{TASK_NAME}','http://{TASK_URL}','{USER_NAME}','{DUE_DATE}','{CASE_NAME}','http://{CASE_URL}','{EMAIL_SIGNATURE}'];
        $value = [$this->assigneFrom->name, $this->task->name,route('task.show', $this->task->id),$this->assigneTo->name,
        formatDate($this->task->due_date),$this->case->title,route('case.show', $this->case->id),config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);

    }
}
