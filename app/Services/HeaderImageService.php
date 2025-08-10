<?php
namespace App\Services;

use Illuminate\Http\Request;

class HeaderImageService {
	public function insertHeaderImage($request){
		$data = $request->all();
        $path = 'images/header-image';
        $do_upload = imageUpload($data['image'], $path ,'public');

        if(!$do_upload){
            abort(500, 'Failed upload image');
        } else {
            $imageURL = asset($path.'/'.$do_upload);
            $data['image_url'] = $imageURL;
        }

        // unset($data['image_url']);

        foreach ($data as $key => $value){ $header_image[$key] = $value; }
        return $header_image;
	}

    public function updateHeaderImage($request){
        $data = $request->all();

        $path = 'images/header-image';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $imageURL = asset($path.'/'.$do_upload);
                $data['image_url'] = $imageURL;
            }
        }

        foreach ($data as $key => $value) { $header_image[$key] = $value; }
        return $header_image;
    }
}
