<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Services\ImageDeleteService;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ImageDeleteService $imagedeleteervices)
    {
        $this->imagedeleteervices = $imagedeleteervices;
    }
    public function deleteImage(Request $request)
    {
        $image_id = $request->id;
        if (isset($image_id)) {
            $image = Image::whereId($image_id)->first();
            //Service for delete image
            $this->imagedeleteervices->handleDeleteImage($image);

            $delete = Image::whereId($image_id)->delete();
            if ($delete) {
                return json_encode(array('result'=>'success'));
            }else{
                return json_encode(array('result'=>'failed'));
            }
        }
    }
}
