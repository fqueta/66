<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Banner;

class BannersController extends Controller
{
    public function index()
    {
        return Banner::where('active', 1)->orderBy('order', 'asc')->select(['id', 'text', 'image_file_name'])->orderByRaw("RAND()")->first();
    }
}
