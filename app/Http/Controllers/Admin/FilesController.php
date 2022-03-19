<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use App\File;
use App\Image;

class FilesController extends Controller
{
	public function fileUpload(Request $request)
	{
		$mimetype = $request->all()['file']->getClientMimeType();
		$type = explode('/', $mimetype);
		$response = ['file' => ['mimetype' => $mimetype]];
		if($type[0] == 'image' || $type[1] == 'png' || $type[1] == 'jpg' || $type[1] == 'jpeg'){
			if($file = Image::create($request->all())){
				$dimensions = getimagesize(public_path() . $file->file->url());
				$response['file']['thumbnail'] = $file->file->url('thumbnail');
				$response['file']['width'] = $dimensions[0];
				$response['file']['height'] = $dimensions[1];
				$response['file']['url'] = ($dimensions[0] >= 1400) ? $file->file->url('resized') : $file->file->url();
				return response()->json($response);
			}
			else
				abort(500);
		}
		else{
			if($file = File::create($request->all())){
				$response['file']['url'] = $file->file->url();
				return response()->json($response);
			}
			else
				abort(500);
		}
	}
}