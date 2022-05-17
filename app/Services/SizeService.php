<?php
namespace App\Services;

use Illuminate\Http\Request;

class SizeService {
	public function insertSize($request){
		$data = $request->all();
        foreach ($data as $key => $value){ $size[$key] = $value; }
        return $size;
	}

    public function insertSpecificSize($request){
        foreach ($request as $key => $value){ $size[$key] = $value; }
        return $size;
	}

    public function updateSize($request){
        $data = $request->all();
        foreach ($data as $key => $value) { $size[$key] = $value; }
        return $size;
    }
}
