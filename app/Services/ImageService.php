<?php

namespace App\Services;

use App\Image;
use App\Move;
use Illuminate\Http\Request;

class ImageService
{
	public function handleUploadedImage($file,$name)
    {
        if (!is_null($file)) {
        	$file->move(public_path('images'),$name);
        }
    }
}