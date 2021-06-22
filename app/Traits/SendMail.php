<?php
namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Modules\Setting\Mail\MailManager;
use Modules\Setting\Model\BusinessSetting;
use App\Mail\TestSmptMail;
use App\Mail\SendSmtpMail;

trait SendMail
{
    //for real using purpose
    function sendMail($to, $subject, $body)
    {

        $attribute = [
                    'from' => env('MAIL_USERNAME'),
                    'subject' => $subject,
                    'content' => $body
                ];
        if (app('general_setting')->mail_protocol  == "smtp") {


                Mail::to($to)->send(new SendSmtpMail($attribute));

                return true;

        }elseif (app('general_setting')->mail_protocol  == "sendmail") {

            $message = (string) view("emails.sendmail",$attribute);
            $headers = "From:>".env('SENDER_MAIL')." \r\n";
            $headers .= "Reply-To:". app('general_setting')->email ." \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            $status =  mail($to, $subject,$message, $headers);
            return true;
        }else{
            return false;
        }
    }


    public function sendMailTest($to, $subject, $body)
    {

        $attribute = [
                    'from' => env('MAIL_USERNAME'),
                    'subject' => $subject,
                    'content' => $body
                ];
        if (app('general_setting')->mail_protocol  == "smtp") {


                Mail::to($to)->send(new TestSmptMail($attribute));


                return true;

        }elseif (app('general_setting')->mail_protocol  == "sendmail") {

            $message = (string) view("emails.mail",$attribute);

            $headers = "From:>".env('SENDER_MAIL')." \r\n";
            $headers .= "Reply-To:". app('general_setting')->email ." \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            $status =  mail($to, $subject,$message, $headers);
            return true;
        }else{
            return false;
        }
    }
}
