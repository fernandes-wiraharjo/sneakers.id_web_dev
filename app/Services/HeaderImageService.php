<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeaderImageService {
	public function insertHeaderImage($request){
		$data = $request->all();
        $path = 'images/header-image';
        $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name);
        $data['image_url'] = uploadAsWebp($data['image'], $path, 'public', 1280, 500, $saveAsFilename);

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
