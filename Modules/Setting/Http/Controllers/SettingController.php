<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Model\BusinessSetting;
use Modules\Setting\Model\EmailTemplate;
use Modules\Setting\Model\SmsGateway;
use Modules\Setting\Model\GeneralSetting;
use Modules\Setting\Model\DateFormat;
use Modules\Setting\Model\Currency;
use Modules\Setting\Model\TimeZone;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\Entities\Config;
use App\Models\Country;

class SettingController extends Controller
{
    public function index()
    {
        try {
            $data['email_templates'] = EmailTemplate::all();
            $data['config'] = Config::all();
            $data['date_formats'] = DateFormat::all()->pluck('normal_view', 'id');

            $data['currencies'] = Currency::all()->pluck('name', 'id');
            $data['timeZones'] = TimeZone::all()->pluck('time_zone', 'id');
            $data['countries'] = Country::all()->pluck('name', 'id');


            return view('setting::index', $data);
        }catch(\Exception $e){
            Toastr::error('Something happend Wrong!', 'Error!!');
            return redirect()->back();
        }
    }

    public function update_activation_status(Request $request)
    {
        $validate_rules = [
            'id' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        session()->forget('g_set');
        session()->forget('sms_set');
        session()->forget('smtp_set');
        try {
            $business_setting = BusinessSetting::findOrFail($request->id);
            if ($business_setting != null) {
                $business_setting->status = $request->status;
                $business_setting->save();

                return 1;
            }

            return 0;
        }catch(\Exception $e){

            Toastr::error(__('common.Something happend Wrong!'), 'Error!!');
            return redirect()->back();
        }
    }

    public function ltr_rtl(Request $request)
    {
        $lt = Config::where('key', 'ttl_rtl')->first();
        $lt->value = $request->ltr ?? 1;
        $lt->save();

        return true;
    }

}
