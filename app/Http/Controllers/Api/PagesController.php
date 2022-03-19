<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::where(['page_id' => 0])->where(['active' => 1])->select(['id', 'title', 'slug', 'order', 'type', 'link', 'target', 'page_id'])->orderBy('order', 'ASC')->with('activePages')->get()->toArray();
        return $pages;
    }

    public function show($slug)
    {
    	return Page::where(['slug' => $slug])->select(['id', 'title', 'content', 'slug', 'type', 'link', 'page_id', 'target', 'updated_at'])->with('parent')->first();
    }
}
