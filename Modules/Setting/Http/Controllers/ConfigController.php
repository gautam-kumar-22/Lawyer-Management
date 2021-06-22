<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Entities\Config;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Modules\Setting\Model\Currency;

class ConfigController extends Controller
{

    public function updateInfo(Request $request)
    {
        if($this->demoCheck() == true){
            return $this->success([
                'demo' => true
            ]);
        }

        $data = $request->except('_token');
        if ($request->favicon_logo != null) {
            $url = $this->saveSettingsImage($request->favicon_logo);
            $data['favicon_logo'] = $url;
        }
        if ($request->site_logo != null) {
            $url = $this->saveSettingsImage($request->site_logo);
            $data['site_logo'] = $url;
        }


        if ($request->currency != null) {
            $currency = Currency::findOrFail($request->currency);
            $data['currency_code'] = $currency->code;
            $data['currency_symbol'] = $currency->symbol;
        }
        foreach($data as $key => $value)
        {
            $config = Config::where('key', $key)->first();

            if($config === null){
                Config::create([
                    'key' => $key,
                    'value' => $value
                ]);
            }else{
                $config->value = $value;
                $config->save();
            }

            $config = null;
        }

        return $this->success([
            'message' => __('setting.GeneralSetting Credentials has been updated Successfully')
        ]);

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

    public function updateLoginBG(Request $request)
    {

        if($this->demoCheck() == true){
            return $this->success([
                'demo' =>true
            ]);
        }
        $validate_rules = [
            'login_backgroud_image' => 'required|mimes:jpg,bmp,png,jpeg'
        ];
        $this->validate($request, $validate_rules, validationMessage($validate_rules));
        try{
            $image = $request->login_backgroud_image;

            if($image){
                $current_date  = Carbon::now()->format('d-m-Y');

                $image_extention = str_replace('image/','',Image::make($image)->mime());


                $img = Image::make($image);
                if(!file_exists('login-asset/img')){
                    mkdir('login-asset/img/', 0777, true);
                }
                $img_name = 'login-asset/img'.'/'.uniqid().'.'.$image_extention;
                $img->save($img_name);


               Config::where('key','login_backgroud_image')->update(['value' => $img_name]);

               return $this->success([
                    'message' => __('setting.Login Backgourd Updated Successfully')
                ]);
            }

            throw ValidationException::withMessages(['message' => 'common.Something Went Wrong']);
        }catch(\Exception $e)
        {
            throw ValidationException::withMessages(['message' => $e->getMessage()]);
        }

    }


}
