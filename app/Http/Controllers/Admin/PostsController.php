<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostsRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Post;
use App\Category;

class PostsController extends AdminController
{
    public $types = ['content' => 'Conteúdo', 'menu' => 'Menu', 'link' => 'Link'];

    public function index()
    {
        $this->saveSession(Input::all());

        $posts = Post::where('title', 'LIKE', '%'.Session::get("filter_posts_title").'%')->orderBy('date', 'desc')->with('category');
        if(Input::has("filter_posts_category_id") && trim(Session::get("filter_posts_category_id")) !== "")
            $posts = $posts->where(['category_id' => Session::get("filter_posts_category_id")]);
        $posts->sortable();
        $count = $posts->count();
        $posts = $posts->paginate(20);
        return view('admin.posts.index', ['posts' => $posts, 'count' => $count, 'types' => $this->types, 'categories' => Category::lists('name', 'id')]);
    }

    public function create()
    {
        return view('admin.posts.add', ['post' => new Post(), 'status' => 'creating', 'types' => $this->types, 'categories' => Category::lists('name', 'id')]);
    }

    public function store(PostsRequest $request)
    {
        $items = $request->all();
        if (Input::has('link') && !preg_match('/http:\/\//', $request->get('link')) && !preg_match('/https:\/\//', $request->get('link')))
            $items['link'] = 'http://'.$items['link'];
        $post = new Post();
        $post->fill($items);
        if($post->save()){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.posts.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.posts.create');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if(AdminController::isEmpty($post))
            return redirect()->route('admin.posts.index');
        return view('admin.posts.edit', ['post' => $post, 'status' => 'editing', 'types' => $this->types, 'categories' => Category::lists('name', 'id')]);
    }

    public function update(PostsRequest $request, $id)
    {
        $post = Post::find($id);
        $post['slug'] = null;
        $items = $request->all();
        if(isset($items['cover_image']) && !$items['cover_image']){
            $post->dimensions = null;
            $post->zoom = null;
        }
        $post->fill($items);
        parseResponse($post);
        if (Input::has('link') && !preg_match('/http:\/\//', $request->get('link')) && !preg_match('/https:\/\//', $request->get('link')))
            $post['link'] = 'http://'.$request->get('link');
        if(AdminController::isEmpty($post))
            return redirect()->route('admin.posts.index');
        if ($post->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($posts = Post::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.posts.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Post::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
