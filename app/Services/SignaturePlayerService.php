<?php
namespace App\Services;

use Illuminate\Http\Request;

class SignaturePlayerService {
	public function insertSignaturePlayer($request){
		$data = $request->all();
        foreach ($data as $key => $value){ $signature[$key] = $value; }
        return $signature;
	}

    public function updateSignaturePlayer($request){
        $data = $request->all();
        foreach ($data as $key => $value) { $signature[$key] = $value; }
        return $signature;
    }
}
