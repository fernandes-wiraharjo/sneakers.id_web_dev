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

        if(isset($data['image'])) {
            $path = 'images/header-image';
            $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name);
            $data['image_url'] = uploadAsWebp($data['image'], $path, 'public', 1280, 500, $saveAsFilename);
        }

        foreach ($data as $key => $value) { $header_image[$key] = $value; }
        return $header_image;
    }
}
