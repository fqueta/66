<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Upload;

class UploadsController extends Controller
{
    public function show($slug)
    {
        $upload = Upload::findBySlug($slug);
        if($upload)
            return response()->download(public_path() . $upload->file->url('original'), $upload->title . "." . explode("/", $upload->file->contentType())[1] );
        else
            return response("", 404);
    }
}
