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

        $emblemFilename = $saveAsFilename . '_emblem';
        $data['emblem_url'] = uploadAsWebp($data['emblem'], $path, 'public', 500, 500, $emblemFilename);

        foreach ($data as $key => $value){ $signature[$key] = $value; }
        return $signature;
	}

    public function updateSignaturePlayer($request){
        $data = $request->all();

        $path = 'images/signature';
        if(isset($data['signature_image'])) {
            $saveAsFilename = Str::slug($data['signature_code']);
            $data['signature_image'] = uploadAsWebp($data['signature_image'], $path, 'public', 427, 856, $saveAsFilename);
        }

        if(isset($data['emblem'])) {
            $saveAsFilename = Str::slug($data['signature_code']);
            $emblemFilename = $saveAsFilename . '_emblem';
            $data['emblem_url'] = uploadAsWebp($data['emblem'], $path, 'public', 500, 500, $emblemFilename);
        }

        foreach ($data as $key => $value) { $signature[$key] = $value; }
        return $signature;
    }
}
