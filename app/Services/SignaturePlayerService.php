<?php
namespace App\Services;

use Illuminate\Http\Request;

class SignaturePlayerService {
	public function insertSignaturePlayer($request){
		$data = $request->all();
        $path = 'images/signature';
        $do_upload = imageUpload($data['image'], $path ,'public');

        if(!$do_upload){
            abort(500, 'Failed upload image');
        } else {
            $data['signature_image'] = $do_upload;
        }

        unset($data['image']);

        foreach ($data as $key => $value){ $signature[$key] = $value; }

        return $signature;
	}

    public function updateSignaturePlayer($request){
        $data = $request->all();
        $path = 'images/signature';

        if(isset($data['image'])) {
            $do_upload = imageUpload($data['image'], $path, 'public');

            if(!$do_upload){
                abort(500, 'Failed upload image');
            } else {
                $data['signature_image'] = $do_upload;
            }

            unset($data['image']);
        }

        foreach ($data as $key => $value) { $signature[$key] = $value; }

        return $signature;
    }
}
