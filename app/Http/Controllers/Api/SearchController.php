<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use App\Post;
use App\Notice;
use App\Bidding;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $input = preg_replace('!\s+!', ' ', trim($request->get('search')));
        $search = "+".str_replace(" ", "+", $input);
        $query = "MATCH(title, parsed_response) AGAINST('". $search ."' IN BOOLEAN MODE)";

        $page = Page::whereRaw($query)->select(['id', 'title', 'content', 'slug', 'type', 'link', 'target'])->get();
        $post = Post::whereRaw($query)->select(['id', 'title', 'content', 'slug', 'date', 'description', 'image_preview_file_name'])->get();
        $notice = Notice::whereRaw($query)->select(['id', 'title', 'content', 'slug', 'date', 'expiration_date'])->get();
        $biddings = Bidding::whereRaw("MATCH(title, object) AGAINST('". $search ."' IN BOOLEAN MODE)")->select(['id', 'title', 'indentifier', 'object', 'opening', 'genre_id', 'phase_id', 'bidding_category_id', 'type_id'])->get();

        return ['page' => $page, 'post' => $post, 'notice' => $notice, 'biddings' => $biddings];
    }
}