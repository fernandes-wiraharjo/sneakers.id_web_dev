<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignaturePlayerService {
	public function insertSignaturePlayer($request){
		$data = $request->all();

        $path = 'images/signature';
        $saveAsFilename = Str::slug($data['signature_code']);
        $data['signature_image'] = uploadAsWebp($data['signature_image'], $path, 'public', 427, 856, $saveAsFilename);

        foreach ($data as $key => $value){ $signature[$key] = $value; }
        return $signature;
	}

    public function updateSignaturePlayer($request){
        $data = $request->all();

        if(isset($data['signature_image'])) {
            $path = 'images/signature';
            $saveAsFilename = Str::slug($data['signature_code']);
            $data['signature_image'] = uploadAsWebp($data['signature_image'], $path, 'public', 427, 856, $saveAsFilename);
        }

        foreach ($data as $key => $value) { $signature[$key] = $value; }
        return $signature;
    }
}
