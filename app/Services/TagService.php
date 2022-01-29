<?php
namespace App\Services;

use Illuminate\Http\Request;

class TagService {
	public function insertTag($request){
		$data = $request->all();
        $path = 'images/tag';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path ,'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['tag_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value){ $tag[$key] = $value; }

        return $tag;
	}

    public function updateTag($request){
        $data = $request->all();
        $path = 'images/tag';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['tag_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $tag[$key] = $value; }

        return $tag;
    }
}
