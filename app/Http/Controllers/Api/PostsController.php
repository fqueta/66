<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

use Image;
use Log;
use File;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $post = Post::select(['id', 'title', 'content', 'slug', 'order', 'active', 'date', 'description', 'image_preview_file_name'])->where(['active' => 1])->orderBy('date', 'desc')->orderBy('id', 'desc');
        if($request->get('latest'))
          $post->take(6);
        if($request->has('page'))
        	$post->skip($request->get('page') * 6)->take(6);
        return ['posts' => $post->get(), 'count' => Post::where(['active' => 1])->count()];
    }

    public function show($slug){
    	return Post::where(['slug' => $slug])->select(['id', 'title', 'content', 'slug', 'order', 'active', 'date', 'description', 'image_preview_file_name', 'cover_image', 'category_id'])->first();
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(!File::exists(public_path().$post->image_preview->url()))
            return response('OK', 200);

        $dimensions = json_decode($request->get('dimensions'));

        $x = (intval($dimensions[2]) - intval($dimensions[0]));
        $y = (intval($dimensions[3]) - intval($dimensions[1]));

        if(!$x && !$y)
            return response('OK', 200);

        $files = File::allFiles(public_path().'/uploads/posts/image_previews/'.$id.'/original/');
        foreach ($files as $file) {
            if($file->getRelativePathName() != $post->image_preview_file_name)
                File::delete(public_path().'/uploads/posts/image_previews/'.$id.'/original/'.$file->getRelativePathName());
        }

        $image = Image::make(public_path().$post->image_preview->url());

        $image->crop($x, $y, intval($dimensions[0]), intval($dimensions[1]))
            ->resize(1920, 700)
            ->encode('jpg', 100)
            ->interlace()
            ->save(public_path().'/uploads/posts/image_previews/'.$id.'/original/cropped.jpg');

        $post->dimensions = $request->get('dimensions');
        $post->zoom = $request->get('zoom');

        $post->save();

        return response('OK', 200);
    }
}
