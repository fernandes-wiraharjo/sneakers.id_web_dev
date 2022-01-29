<?php
namespace App\Services;

use Illuminate\Http\Request;

class BannerService {
	public function insertBanner($request){
		$data = $request->all();
        $path = 'images/banner';
        $do_upload = imageUpload($data['image'], $path ,'public');

        if(!$do_upload){
            abort(500, 'Failed upload image');
        } else {
            $data['banner_image'] = $do_upload;
        }

        unset($data['image']);

        foreach ($data as $key => $value){ $banner[$key] = $value; }

        return $banner;
	}

    public function updateBanner($request){
        $data = $request->all();
        $path = 'images/banner';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['banner_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $banner[$key] = $value; }

        return $banner;
    }
}
