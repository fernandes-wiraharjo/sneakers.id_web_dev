<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Modules\HeaderImage\Entities\HeaderImage;

class HeaderImageService {
	public function insertHeaderImage($request){
		$data = $request->all();
        $path = 'images/header-image';
        $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name);
        $data['image_url'] = uploadAsWebp($data['image'], $path, 'public', 1280, 500, $saveAsFilename);

        foreach ($data as $key => $value){ $header_image[$key] = $value; }
        return $header_image;
	}

    public function updateHeaderImage($request, $currentId = null){
        $data = $request->all();

        // Only update image_url if a new image is uploaded
        if($request->hasFile('image')) {
            // Delete the old image file from storage
            if ($currentId) {
                $existingRecord = HeaderImage::find($currentId);
                if ($existingRecord && $existingRecord->image_url) {
                    // Extract the file path from the URL
                    $oldImagePath = str_replace('/storage/', '', parse_url($existingRecord->image_url, PHP_URL_PATH));
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
            }

            $path = 'images/header-image';
            $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name.' '.time());
            
            $data['image_url'] = uploadAsWebp($data['image'], $path, 'public', 1280, 500, $saveAsFilename);
        } else {
            // Remove image from data array if no new image is uploaded
            unset($data['image']);
        }

        foreach ($data as $key => $value) { $header_image[$key] = $value; }
        return $header_image;
    }
}
