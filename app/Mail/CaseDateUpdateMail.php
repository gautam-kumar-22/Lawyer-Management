<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class CaseDateUpdateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client, $case, $date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $case, $date)
    {
        $this->client = $client;
        $this->case = $case;
        $this->date = $date;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        $tamplate = EmailTemplate::where('type', 'case_date_change')->first();

        $subject= $tamplate->subject;
        $body = $tamplate->value;
        
        $key = ['{CLIENT_NAME}','{CASE_NAME}','{CASE_DATE}','{HEARING_TYPE}','http://{CASE_URL}','{EMAIL_SIGNATURE}'];
        $value = [$this->client->name,$this->case->title, formatDate($this->date->date),
        $this->date->type,route('case.show',$this->case->id),config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
