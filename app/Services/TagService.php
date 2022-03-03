<?php
namespace App\Services;

use Illuminate\Http\Request;

class TagService {
	public function insertTag($request){
		$data = $request->all();
        foreach ($data as $key => $value){ $tag[$key] = $value; }
        return $tag;
	}

    public function updateTag($request){
        $data = $request->all();
        foreach ($data as $key => $value) { $tag[$key] = $value; }
        return $tag;
    }
}
