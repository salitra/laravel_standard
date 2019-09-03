<?php

namespace App\Services;
use File;

class ImageDeleteService
{
	public function handleDeleteImage($image)
    {
        $image_path = public_path() ."/images/".$image->image_name;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}