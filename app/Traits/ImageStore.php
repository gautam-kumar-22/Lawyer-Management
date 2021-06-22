<?php

namespace App\Traits;

use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use File;

trait ImageStore
{
    public function saveImage($image, $height = null ,$lenght = null)
    {
        if(isset($image)){

            $current_date  = Carbon::now()->format('d-m-Y');

            if(!File::isDirectory('uploads/images/'.$current_date)){

                File::makeDirectory('uploads/images/'.$current_date, 0777, true, true);

            }

            $image_extention = str_replace('image/','',Image::make($image)->mime());

            if($height != null && $lenght != null ){
                $img = Image::make($image)->resize($height, $lenght);
            }else{
                $img = Image::make($image);
            }

            $img_name = 'uploads/images/'.$current_date.'/'.uniqid().'.'.$image_extention;
            $img->save($img_name);

            return $img_name;

        }else{

            return null ;
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

            $img_name = 'uploads/settings'.'/'.uniqid().'.'.$image_extention;
            $img->save($img_name);

            return $img_name;

        }else{

            return null ;
        }

    }


    public function deleteImage($url)
    {
        if(isset($url)){

            if (File::exists($url)) {

                File::delete($url);

                return true;

            }else{
                return false;
            }

        }else{

            return null ;
        }

    }

    public function saveAvatar($image, $height = null ,$lenght = null)
    {
        if(isset($image)){

            $current_date  = Carbon::now()->format('d-m-Y');

            if(!File::isDirectory('uploads/avatar/'.$current_date)){

                File::makeDirectory('uploads/avatar/'.$current_date, 0777, true, true);

            }

            $image_extention = str_replace('image/','',Image::make($image)->mime());

            if($height != null && $lenght != null ){
                $img = Image::make($image)->resize($height, $lenght);
            }else{
                $img = Image::make($image);
            }

            $img_name = 'uploads/avatar/'.$current_date.'/'.uniqid().'.'.$image_extention;
            $img->save($img_name);

            return $img_name;
        }else{
            return null ;
        }

    }

    public function saveFile($file)
    {
        $name = $file->getClientOriginalName();
        $file->move('uploads/file/', $name);

        return $name;
    }

    public function storeFile($file, $case_id,  $hearing_date_id=null ){
        if (!$file){
            return;
        }
        if (!file_exists('public/uploads/case-file')) {
            mkdir('public/uploads/case-file', 0777, true);
        }

        $fileName = time() .'-'.uniqid('infix-').'.'. $file->getClientOriginalExtension();
        $file->move('public/uploads/case-file/', $fileName);
        $path = 'public/uploads/case-file/' . $fileName;
        $image_url = asset($path);

        $upload = new Upload();
        $upload->uuid = Str::uuid();
        $upload->user_id = Auth::id();
        $upload->case_id = $case_id;
        $upload->hearing_date_id = $hearing_date_id;
        $upload->user_filename = $file->getClientOriginalName();
        $upload->filename = $image_url;
        $upload->filepath = $path;
        $upload->file_type = $file->getClientMimeType();
        $upload->save();
    }

    public function updateFile($file, $upload ){
        if (\Illuminate\Support\Facades\File::exists($upload->filepath)){
            \Illuminate\Support\Facades\File::delete($upload->filepath);
        }
        $fileName = time() .'-'.uniqid('infix-').'.'. $file->getClientOriginalExtension();
        $file->move('public/uploads/case-file/', $fileName);
        $path = 'public/uploads/case-file/' . $fileName;
        $image_url = asset($path);

        $upload->user_id = Auth::id();
        $upload->user_filename = $file->getClientOriginalName();
        $upload->filename = $image_url;
        $upload->filepath = $path;
        $upload->file_type = $file->getClientMimeType();
        $upload->save();
    }
}
