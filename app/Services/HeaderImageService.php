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

        // Only update image_url if a new image is uploaded
        if($request->hasFile('image')) {
            $path = 'images/header-image';
            $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name);
            $data['image_url'] = uploadAsWebp($data['image'], $path, 'public', 1280, 500, $saveAsFilename);
        } else {
            // Remove image from data array if no new image is uploaded
            unset($data['image']);
        }

        foreach ($data as $key => $value) { $header_image[$key] = $value; }
        return $header_image;
    }
}
