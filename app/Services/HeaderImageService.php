<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Modules\HeaderImage\Entities\HeaderImage;

class HeaderImageService {
	public function insertHeaderImage($request){
        $path = 'images/header-image';
        $saveAsFilename = Str::slug($request->menu_parent_name.' '.$request->menu_name);

        return [
            'menu_parent_name' => $request->menu_parent_name,
            'menu_name' => $request->menu_name,
            'is_active' => $request->boolean('is_active'),
            'image_url' => uploadAsWebp($request->file('image'), $path, 'public', 1280, 500, $saveAsFilename),
        ];
	}

    public function updateHeaderImage($request, $currentId = null){
        $header_image = [
            'menu_parent_name' => $request->menu_parent_name,
            'menu_name' => $request->menu_name,
            'is_active' => $request->boolean('is_active'),
        ];

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

            $header_image['image_url'] = uploadAsWebp($request->file('image'), $path, 'public', 1280, 500, $saveAsFilename);
        }

        return $header_image;
    }
}
