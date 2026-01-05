<?php
namespace App\Services;

use Illuminate\Http\Request;

class GlobalSettingService {
	public function insertGlobalSetting($request){
		$data = $request->all();

        if (isset($data['image'])) {
            $path = 'images/global-setting';
            $do_upload = imageUpload($data['image'], $path ,'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                // Rewrite value to image URL
                $data['setting_value'] = asset($path.'/'.$do_upload);
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value){ $brand[$key] = $value; }
        return $brand;
	}

    public function updateGlobalSetting($request){
        $data = $request->all();

        $path = 'images/global-setting';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                // Rewrite value to image URL
                $data['setting_value'] = asset($path.'/'.$do_upload);
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $brand[$key] = $value; }
        return $brand;
    }
}
