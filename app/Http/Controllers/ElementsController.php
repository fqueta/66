<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ElementsController extends Controller
{
    public function show($folder, $page = null)
    {
    	if($page != null)
    		$folder = $folder.'.'.$page;
    	else
    		$folder = 'home.'.$folder;
        return view('elements.'.$folder);
    }

    public function success($id)
    {
    	return view('elements.home.success');
    }
}
