<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Imagine\Image\ImageInterface;

class Intervention extends Model
{
  public static function resizeImage($file, $imagine, $width = 100, $height = 100, $blur = false)
	{
		$image = Image::make($file->getRealPath())
			->resize($width, $height, function($constraint){
				$constraint->aspectRatio();
    		$constraint->upsize();
			});
		if($blur)
			$image = $image->blur(100);
    return $imagine->load($image->encode('jpg', 100))->interlace('line');
	}

	public static function fitImage($file, $imagine, $width = 100, $height = 100, $blur = false)
	{
		$image = Image::make($file->getRealPath())
			->fit($width, $height);
		if($blur)
			$image = $image->blur(100);
    return $imagine->load($image->encode('jpg', 100))->interlace('line');
	}
}
