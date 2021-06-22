<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tamplate = EmailTemplate::where('type', 'welcome_mail')->first();

        $subject= $tamplate->subject;
        $body = $tamplate->value;
        
        $key = ['{USER_NAME}','{APP_NAME}','{EMAIL_SIGNATURE}'];
        $value = [$this->user['name'],config('configs')->where('key', 'site_title')->first()->value,config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
