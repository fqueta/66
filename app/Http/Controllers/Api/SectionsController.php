<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section;

class SectionsController extends Controller
{
    public function index()
    {
        return Section::select(['id', 'name'])->orderBy('name', 'asc')->get();
    }
}
