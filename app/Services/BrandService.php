<?php
namespace App\Services;

use Illuminate\Http\Request;

class BrandService {
	public function insertBrand($request){
		$data = $request->all();
        foreach ($data as $key => $value){ $brand[$key] = $value; }
        return $brand;
	}

    public function updateBrand($request){
        $data = $request->all();
        foreach ($data as $key => $value) { $brand[$key] = $value; }
        return $brand;
    }
}
