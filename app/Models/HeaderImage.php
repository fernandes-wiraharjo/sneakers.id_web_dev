<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderImage extends Model
{
    use HasFactory;

    protected $table = 'header_images';

    protected $fillable = [
        'menu_name',
        'menu_parent_name',
        'image_url',
        'is_active'
    ];

    public function getHeaderImage($menu_parent_name, $menu_name)
    {
        $imageData = $this->where('menu_parent_name', $menu_parent_name)
            ->whereRaw('LOWER(menu_name) = ?', [strtolower($menu_name)])
            ->where('is_active', true)
            ->first();

        if ($imageData) {
            return $imageData->image_url;
        }

        return 'https://placehold.co/1280x400?text=Header+Image+Placeholder';
    }
}
