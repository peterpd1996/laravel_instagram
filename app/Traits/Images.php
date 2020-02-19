<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait Images
{
    function uploadImage($file)
    {
            $imgName = $file->getClientOriginalName();
            $imgName = time() . rand(0, 999999) . $imgName;
            $imageResize = Image::make($file)->resize(600,600)->save(public_path('/uploads/' . $imgName));
            return $imgName;
    }
    function deleteImage($image)
    {
        $image_path = "uploads/".$image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    function deleteMultiImage($images)
    {
        foreach ($images as $image)
        {
            $this->deleteImage($image);
        }
    }
}

