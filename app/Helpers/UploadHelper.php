<?php

use BaconQrCode\Renderer\Path\Path;
use Intervention\Image\Facades\Image;

if (!function_exists('imageUpload')) {

    /**
     * description
     *
     * @param $file => $request->hasFile('Image)
     * $type => 'public' / 'storage' / 's3'
     * @return $newfilename
     */
    function imageUpload($file, $path, $type, $queue = false, $number = 0, $custom_name = '')
    {
        $imageName = time().'.'.$file->extension();

        if($queue){
            $imageName = $number.'_'.($custom_name != '' ? $custom_name .'_' : '').$imageName;
        }

        switch ($type) {
            case 'public' :
                $path = public_path($path);
                $stored = $file->move($path, $imageName);
            break;
            case 'storage' :
                $stored = $file->storeAs($path, $imageName);
            break;
            case 's3' :
                $stored = $file->storeAs($path,$imageName,'s3');
            break;
        }

        if($stored){
            return $imageName;
        } else {
            return false;
        }
        //return $imageName;
    }
}

if(!function_exists('imageUploadProduct')) {
    /**
     * product image 1x1
     */

    function imageUploadProduct($file, $path, $type, $queue = false, $number = 0, $custom_name = '')
    {
        $resolution = [1800];//[200, 300,400,600,700,800,900,1000,1200, 1800];
        $image_new_name = time().'.'.$file->extension();
        $time = time();

        if($queue){
            $imageName = $number.'_'.($custom_name != '' ? $custom_name .'_' : '').$image_new_name;
        }

        switch ($type) {
            case 'public' :
                $path = public_path($path);

                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                foreach($resolution as $item){
                    $img = Image::make($file->path());
                    if($item == 1800) {
                        $resize_file_name = $number.'_'.($custom_name != '' ? $custom_name .'_' : '').$time.'_1800x1800'.'.'.$file->extension();
                    } else {
                        $resize_file_name = $number.'_'.($custom_name != '' ? $custom_name .'_' : '').$time.'_'.$item.'.'.$file->extension();
                    }

                    $img->resize($item, $item, function ($const) {
                        $const->aspectRatio();
                    })->save($path.'/'.$resize_file_name);
                }


                $stored = $file->move($path, $imageName);
            break;
            case 'storage' :
                $stored = $file->storeAs($path, $imageName);
            break;
            case 's3' :
                $stored = $file->storeAs($path,$imageName,'s3');
            break;
        }

        if($stored){
            return $imageName;
        } else {
            return false;
        }
    }
}

if (!function_exists('getImage')) {
    function getImage($filename, $module = ''){
        if ($filename && $module) {
            return asset('images/'.$module.'/'.$filename);
        } else {
            return asset('demo1/media/blank/blank-image.png');
        }
    }
}

if(!function_exists('removeImageFromStorage')) {
    function removeImageFromStorage($path = '', $filename = ''){
        $image_path = public_path($path."/".$filename);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        return true;
    }
}

if(!function_exists('moveImage')) {
    function moveImage($beforePath = '', $afterPath = '', $filename = ''){
        $image_before_path = public_path($beforePath."/".$filename);
        $image_after_path = public_path($afterPath."/".$filename);

        if(File::exists($image_before_path)) {
            File::move($image_before_path, $image_after_path);
        }

        return true;
    }
}
