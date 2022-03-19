<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Floater;

class FloatersController extends Controller
{
	public function index()
	{
		return Floater::where('active', 1)->orderByRaw('RAND()')->select(['id', 'name', 'desktop_file_name', 'mobile_file_name', 'link'])->first();
	}
}
