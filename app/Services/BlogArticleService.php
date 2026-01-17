<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogArticleService {
	public function insertBlogArticle($request){
		$data = $request->all();
		
		// Set author from authenticated user if not provided
		if(empty($data['author'])) {
			$data['author'] = auth()->user()->name;
		}
		
		// Upload featured image (required on create)
		if(isset($data['featured_image'])) {
			$path = 'images/blog';
			$saveAsFilename = Str::slug($data['title']) . '_' . time();
			$data['featured_image_url'] = uploadAsWebp($data['featured_image'], $path, 'public', 1200, 630, $saveAsFilename);
			unset($data['featured_image']);
		}
		
		// Generate slug from title if not provided
		if(empty($data['slug'])) {
			$data['slug'] = Str::slug($data['title']);
		}
		
		// Strip HTML tags from content for plain_text (for search)
		if(isset($data['content'])) {
			$plainText = strip_tags($data['content']);
			// Decode HTML entities
			$plainText = html_entity_decode($plainText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
			// Replace multiple whitespace characters (spaces, tabs, newlines) with single space
			$plainText = preg_replace('/\s+/', ' ', $plainText);
			// Trim leading and trailing whitespace
			$data['plain_text'] = trim($plainText);
		}

        foreach ($data as $key => $value){ 
			$blogArticle[$key] = $value; 
		}
        return $blogArticle;
	}

    public function updateBlogArticle($request){
        $data = $request->all();
		
		// Set author from authenticated user if not provided
		if(empty($data['author'])) {
			$data['author'] = auth()->user()->name;
		}
		
		// Upload featured image if provided
		if(isset($data['featured_image'])) {
			$path = 'images/blog';
			$saveAsFilename = Str::slug($data['title']) . '_' . time();
			$data['featured_image_url'] = uploadAsWebp($data['featured_image'], $path, 'public', 1200, 630, $saveAsFilename);
			unset($data['featured_image']);
		}
		
		// Generate slug from title if not provided
		if(empty($data['slug'])) {
			$data['slug'] = Str::slug($data['title']);
		}
		
		// Strip HTML tags from content for plain_text (for search)
		if(isset($data['content'])) {
			$plainText = strip_tags($data['content']);
			// Decode HTML entities
			$plainText = html_entity_decode($plainText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
			// Replace multiple whitespace characters (spaces, tabs, newlines) with single space
			$plainText = preg_replace('/\s+/', ' ', $plainText);
			// Trim leading and trailing whitespace
			$data['plain_text'] = trim($plainText);
		}

        foreach ($data as $key => $value) { 
			$blogArticle[$key] = $value; 
		}
        return $blogArticle;
    }
}

