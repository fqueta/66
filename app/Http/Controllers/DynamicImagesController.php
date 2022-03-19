<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;
use Image;

class DynamicImagesController extends Controller
{
    public function index(Request $request)
    {
        $original_src = $request->get('src');
        $src =  explode('/', $original_src);
        $width = $request->get('width');
        $src[count($src) - 1] = $width."-".$src[count($src) - 1];
        $src = implode('/', $src);

        if(File::exists(public_path().$src))
            return response(File::get(public_path().$src))->header('Content-Type', 'image/jpg');
        if(!File::exists(public_path().$original_src))
            return response('File not found', 404);
        if(!in_array(pathinfo(public_path().$original_src, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
            return response()->download(public_path().$original_src);

        $file = File::get(public_path().$original_src);
        $img = Image::make(File::get(public_path().$original_src));
        $img->resize($width, null, function($constraint){
            $constraint->aspectRatio();
        })->encode('jpg', 100)->interlace()->save(public_path().$src);

        return response(File::get(public_path().$src))->header('Content-Type', 'image/jpg');

    }
}
