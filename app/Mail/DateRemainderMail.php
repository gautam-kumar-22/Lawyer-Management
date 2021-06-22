<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class DateRemainderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tamplate = EmailTemplate::where('type', 'due_date_remider')->first();

        $subject= $tamplate->subject;
        $body = $tamplate->value;
        
        $key = ['{USER_NAME}','{TASK_NAME}','http://{TASK_URL}','{LAST_DATE}','{EMAIL_SIGNATURE}'];
        $value = [$this->task->assignee->name, $this->task->name,route('task.show',$this->task->id), formatDate($this->task->due_date),
        config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
