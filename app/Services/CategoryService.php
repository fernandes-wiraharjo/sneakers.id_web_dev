<?php
namespace App\Services;

use Illuminate\Http\Request;

class CategoryService {
	public function insertCategory($request){
		$data = $request->all();
        foreach ($data as $key => $value){ $category[$key] = $value; }
        return $category;
	}

    public function updateCategory($request){
        $data = $request->all();
        foreach ($data as $key => $value) { $category[$key] = $value; }
        return $category;
    }
}
