<?php
namespace App\Services;

use Illuminate\Http\Request;

class FaqService {
	public function insertFaq($request){
		$data = $request->all();

        foreach ($data as $key => $value){ $tag[$key] = $value; }

        return $tag;
	}

    public function updateFaq($request){
        $data = $request->all();

        foreach ($data as $key => $value) { $tag[$key] = $value; }

        return $tag;
    }
}
