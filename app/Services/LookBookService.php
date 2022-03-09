<?php
namespace App\Services;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LookBookService {
	public function insertLookBook($request){
        $data = $request->all();

        $path = 'images/lookbook';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path ,'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['look_book_image'] = $do_upload;
            }

            unset($data['image']);
        }

        unset($data['token']);

        foreach ($data as $key => $value){ $lookbook[$key] = $value; }

        return $lookbook;
	}

    public function updateLookBook($id, $request){
        $data = $request->all();

        $path = 'images/lookbook';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path ,'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['look_book_image'] = $do_upload;
            }

            unset($data['image']);
        }

        unset($data['token']);

        foreach ($data as $key => $value){ $lookbook[$key] = $value; }

        return $lookbook;
    }
}
