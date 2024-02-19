<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    function uploadImage($image, $folder)
    {
        $getClientMimeType = explode('/', $image->getClientMimeType());
        $extension = $image->getClientOriginalExtension();

        // Generate a unique image name using a random string and the current timestamp
        $image_name = 'dish_' . str::random(2) . '_' . time() . '.' . $extension;

        // Move the image to the desired folder
        $image->move(public_path($folder), $image_name);

        return $image_name;
    }
}
