<?php
namespace App\Services;

use Illuminate\Http\Request;

class EcommerceLinkService {
	public function insertEcommerceLink($request){
		$data = $request->all();
        $path = 'images/ecommerce-link';
        $do_upload = imageUpload($data['image'], $path ,'public');

        if(!$do_upload){
            abort(500, 'Failed upload image');
        } else {
            $data['ecommerce_image'] = $do_upload;
        }

        unset($data['image']);

        foreach ($data as $key => $value){ $ecommerce[$key] = $value; }

        return $ecommerce;
	}

    public function updateEcommerceLink($request){
        $data = $request->all();
        $path = 'images/ecommerce-link';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['ecommerce_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $ecommerce[$key] = $value; }

        return $ecommerce;
    }
}
