<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Model\GeneralSetting;
use Modules\Setting\Model\SmsGateway;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Setting\Model\Currency;
use Modules\Setting\Model\EmailTemplate;
use Modules\Setting\Repositories\GeneralSettingRepositoryInterface;
use App\Traits\SendSMS;
use App\Traits\SendMail;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Modules\Setting\Emails\TestSendMail;
use Modules\Setting\Emails\TestSmtpMail;
use Mail;
use Modules\Setting\Entities\Config;

class GeneralSettingsController extends Controller
{

    protected $generalsettingRepository;

    public function __construct(GeneralSettingRepositoryInterface $generalsettingRepository)
    {
        $this->middleware(['auth']);
        $this->generalsettingRepository = $generalsettingRepository;
    }

    public function update(Request $request)
    {
        if ($request->email) {
            $validate_rules = [
                "email" => "required",
                "phone" => "required",
                "address" => "required",
            ];
        } else {
            $validate_rules = [
                "site_title" => "required|string|max:30",
                "file_supported" => "nullable|string",
                "copyright_text" => "nullable|string",
                "date_format_id" => "required",
                "currency_id" => "required",
                "time_zone_id" => "required",
                "preloader" => "required",
                "invoice_prefix" => "nullable",
                "agent_commission_type" => "nullable",
                "sale_margin_price" => "nullable",
                "site_logo" => "nullable|mimes:jpg,png,jpeg",
                "favicon_logo" => "nullable|mimes:jpg,png,jpeg"
            ];
        }


        $request->validate($validate_rules, validationMessage($validate_rules));


        if ($request->favicon_logo != null) {
            $url = $this->saveSettingsImage($request->favicon_logo);
            $request->merge(["favicon"=>$url]);
        }
        if ($request->site_logo != null) {
            $url = $this->saveSettingsImage($request->site_logo);
            $request->merge(["logo"=>$url]);
        }
        if ($request->currency_id != null) {
            $currency = Currency::findOrFail($request->currency_id);
            $request->merge(["currency_symbol"=>$currency->symbol , "currency"=>$request->currency_id , "currency_code"=>$currency->code]);
        }

        try {
            $this->generalsettingRepository->update($request->except("_token","favicon_logo","site_logo","currency_id","status", "g_set"));
            if ($request->ajax()) {
                return $this->success([
                    'message' => __('setting.GeneralSetting Credentials has been updated Successfully')
                ]);
            } else {
                Toastr::success(__('setting.GeneralSetting Credentials has been updated Successfully'));
                session()->put('g_set', '1');
                session()->forget('sms_set');
                session()->forget('smtp_set');
                session()->forget('email_template');

                return back();
            }
        } catch (\Exception $e) {

            if ($request->ajax())
                return response()->json(['error' => trans('common.Something Went Wrong')]);
            else {
                Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
                return back();
            }
        }
    }


    public function company_details_update(Request $request)
    {
         try {
            $this->generalsettingRepository->update($request->except("_token","favicon_logo","site_logo","currency_id"));

            return $this->success([
                'message' =>  __('setting.GeneralSetting Credentials has been updated Successfully')
            ]);



        }catch(\Exception $e){

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }


    public function overWriteEnvFile($type, $val)
    {
        try {
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"' . trim($val) . '"';
                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)
                    ));
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }

    }

    public function sms_gateway_credentials_update(Request $request)
    {
        $validate_rules = [
            'sms_gateway_id' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try {
            foreach (SmsGateway::all() as $key => $sms_gateway) {
                $sms_gateway->status = 0;
                $sms_gateway->save();
            }
            $sms_gateway = SmsGateway::findOrFail($request->sms_gateway_id);
            $sms_gateway->status = 1;
            $sms_gateway->save();
            foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
            }
            session()->forget('g_set');
            session()->forget('smtp_set');
            session()->forget('email_template');
            session()->put('sms_set', '1');
            Toastr::success(__('setting.SMS Gateways Credentials has been updated Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }

    public function sms_send_demo(Request $request)
    {
        try {
            $this->sendSMS($request->number, env("APP_NAME"), $request->message);
            Toastr::success(__('setting.SMS has been sent Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }

    public function smtp_gateway_credentials_update(Request $request)
    {
        if($this->demoCheck() == true){
            Toastr::warning('This Features is disabled for demo.');
            return back();
        }

        $validate_rules = [
            'mail_protocol' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {

            $data = $request->except('_token');
            foreach($data as $key => $value)
            {
                $config = Config::where('key', $key)->first();

                if($config != null){
                    $config->value = $value;
                    $config->save();
                }

                $config = null;
            }


            if ($request->mail_protocol == 'smtp') {
                $request->merge(["MAIL_MAILER" => "smtp"]);
            } else {
                $request->merge(["MAIL_MAILER" => $request->mail_protocol]);
            }

            $arr = [];
            foreach ($request->types as $key => $type) {
                $arr[$type] = $request[$type];
            }

            envu($arr);

            Toastr::success(__('setting.SMTP Gateways Credentials has been updated Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }

    public function test_mail_send(Request $request)
    {

        try {
            $mail = $this->sendMailTest($request->email, "Test Mail", $request->content);

            if ($mail == true) {
               return $this->success([
                   'message' => 'Test Mail successfully send'
               ]);
            }

        } catch (\Exception $e) {
            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }

    public function template_update(Request $request)
    {
        if($this->demoCheck() == true){
            return $this->success([
                'demo' => true
            ]);
        }

        $email_template = EmailTemplate::where('type', $request->name)->first();
        $email_template->subject = $request->subject;
        $email_template->value = $request->value;
        $email_template->status = $request->status ? 1 : 0;
        $email_template->save();
        session()->put('email_template', '1');
        session()->forget('g_set');
        session()->forget('smtp_set');
        session()->forget('smtp_set');

        return $this->success([
            'message' => 'Tamplate has been updated Successfully'
        ]);
    }

    public function footer_update(Request $request)
    {
        try {
            $general_setting = GeneralSetting::first();
            $general_setting->mail_footer = $request->mail_footer;
            $general_setting->save();
            session()->put('email_template', '1');
            session()->forget('g_set');
            session()->forget('smtp_set');
            session()->forget('smtp_set');

            Toastr::success(__('setting.Email Footer has been updated Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }



    public function saveSettingsImage($image, $height = null ,$lenght = null)
    {
        if(isset($image)){

            $current_date  = Carbon::now()->format('d-m-Y');

           $image_extention = str_replace('image/','',Image::make($image)->mime());

           if($height != null && $lenght != null ){
               $img = Image::make($image)->resize($height, $lenght);
           }else{
               $img = Image::make($image);
           }
           if(!file_exists('uploads/settings')){
               mkdir('uploads/settings/', 0777, true);
           }
           $img_name = 'uploads/settings'.'/'.uniqid().'.'.$image_extention;
           $img->save($img_name);

           return $img_name;

        }else{

            return null ;
        }

    }


    public function sendMailTest($to, $subject, $body)
    {

        $attribute = [
                    'from' => env('MAIL_USERNAME'),
                    'subject' => $subject,
                    'content' => $body
                ];
        if (config('configs')->where('key', 'mail_protocol')->first()->value  == "smtp") {

                    Mail::to($to)->send(new TestSmtpMail($attribute));

                return true;

        }elseif (config('configs')->where('key', 'mail_protocol')->first()->value  == "sendmail") {

            $message = (string) view("emails.mail",$attribute);

            $headers = "From:>".env('SENDER_MAIL')." \r\n";
            $headers .= "Reply-To:". config('configs')->where('key', 'email')->first()->value ." \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            $status =  mail($to, $subject,$message, $headers);
            return true;
        }else{
            return false;
        }
    }

}
