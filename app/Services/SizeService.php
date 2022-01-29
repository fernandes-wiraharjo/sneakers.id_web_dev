<?php
namespace App\Services;

use Illuminate\Http\Request;

class SizeService {
	public function insertSize($request){
		$data = $request->all();
        $path = 'images/size';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path ,'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['size_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value){ $size[$key] = $value; }

        return $size;
	}

    public function updateSize($request){
        $data = $request->all();
        $path = 'images/size';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['size_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $size[$key] = $value; }

        return $size;
    }
}
