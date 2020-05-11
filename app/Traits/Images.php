<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait Images
{
    function uploadImage($file)
    {
            $filename = $file->getClientOriginalName();
            $extension =  pathinfo($filename, PATHINFO_EXTENSION);
            if($extension != 'mp4')
            {
                $filename = time() . rand(0, 999999) . $filename;
                $file->move(public_path('/uploads/'), $filename);
                //$imageResize = Image::make($file)->resize(600,600)->save(public_path('/uploads/' . $filename));
            }
            else
            {
                $filename = time() . rand(0, 999999) . $filename;
                $file->move(public_path('/videos/'), $filename);
            }
            
            return $filename;
    }
    function deleteImage($image)
    {
        if(pathinfo($image, PATHINFO_EXTENSION) != 'mp4')
        {
             $filePath = "uploads/".$image;
        }
        else
        {
             $filePath = "videos/".$image;
        }

        if (file_exists($filePath)) {
            unlink($filePath);
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

