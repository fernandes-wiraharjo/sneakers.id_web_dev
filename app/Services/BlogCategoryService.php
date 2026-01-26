<?php
namespace App\Services;

use Illuminate\Http\Request;

class BlogCategoryService {
	public function insertBlogCategory($request){
		$data = $request->all();
		
		// Ensure ID is lowercase
		if(isset($data['id'])) {
			$data['id'] = strtolower($data['id']);
		}

        foreach ($data as $key => $value){ 
			$blogCategory[$key] = $value; 
		}
        return $blogCategory;
	}

    public function updateBlogCategory($request){
        $data = $request->all();
		
		// Ensure ID is lowercase
		if(isset($data['id'])) {
			$data['id'] = strtolower($data['id']);
		}

        foreach ($data as $key => $value) { 
			$blogCategory[$key] = $value; 
		}
        return $blogCategory;
    }
}

