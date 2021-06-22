<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Modules\Leave\Entities\ApplyLeave;
use Modules\Setting\Model\SmsGateway;

trait Notification
{
    use SendMail,SendSMS;

    public function isEnableEmail()
    {
        $email = app('business_settings')->where('type','email_verification')->where('status',1)->first();
        if ($email)
            return true;
        return false;
    }

    public function isEnableSMS()
    {
        $email = app('business_settings')->where('type','sms_verification')->where('status',1)->first();
        if ($email)
            return true;
        return false;
    }

    public function isEnableSystem()
    {
        $email = app('business_settings')->where('type','system_notification')->where('status',1)->first();
        if ($email)
            return true;
        return false;
    }


    public function sendNotification($type,$email,$subject,$content,$number,$message,$user_id=null,$role=null,$url=null)
    {
        if ($this->isEnableEmail() && $email)
        {
            $this->sendMail($email,$subject,$content);
        }
        if ($this->isEnableSMS() && $number)
        {
            $this->sendSMS($number,$message);
        }
        if ($this->isEnableSystem())
        {
            \Modules\Notification\Entities\Notification::create([
                'user_id' => $user_id,
                'role' => $role,
                'type' => $subject,
                'notifiable_type' => get_class($type),
                'notifiable_id' => $type->id,
                'data' => $message,
                'url' => $url,
            ]);
        }
       return true;
    }
}
