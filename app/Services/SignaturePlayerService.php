<?php
namespace App\Services;

use Illuminate\Http\Request;

class SignaturePlayerService {
	public function insertSignaturePlayer($request){
		$data = $request->all();

        $path = 'images/signature/'.$data['signature_code'];
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

        if(isset($data['image'])) {
            $path = 'images/signature/'.$data['signature_code'];
            $do_upload = imageUpload($data['image'], $path ,'public');

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
