<?php
namespace App\Services;

use Illuminate\Http\Request;

class BrandService {
	public function insertBrand($request){
		$data = $request->all();

        $path = 'images/brand';
        $do_upload = imageUpload($data['image'], $path ,'public');

        if(!$do_upload){
            abort(500, 'Failed upload image');
        } else {
            $data['brand_image'] = $do_upload;
        }

        unset($data['image']);

        foreach ($data as $key => $value){ $brand[$key] = $value; }
        return $brand;
	}

    public function updateBrand($request){
        $data = $request->all();

        $path = 'images/brand';
        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['brand_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $brand[$key] = $value; }
        return $brand;
    }
}
