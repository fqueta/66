<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;

use App\Category;

use Input;
use Session;

class CategoriesController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());
        $categories = Category::where('name', 'LIKE', '%'.Session::get("filter_categories_name").'%')->orderBy('order', 'ASC');
        $count = $categories->count();
        $categories = $categories->paginate(20);
        return view('admin.categories.index', ['categories' => $categories, 'count' => $count]);
    }

    public function create()
    {
        return view('admin.categories.add', ['category' => new Category()]);
    }

    public function store(CategoriesRequest $request)
    {
        $items = $request->all();
        if (Category::create($items)) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.categories.index');
        } else
            Session::flash('flash_warnig', 'record_failed');
            return view('admin.categories.add');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if(AdminController::isEmpty($category))
            return redirect()->route('admin.categories.index');
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(CategoriesRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->all());
        if(AdminController::isEmpty($category))
            return redirect()->route('admin.categories.index');
        if (!AdminController::isEmpty($category) && $category->save()){
            \Session::flash('flash_sucess', 'edit_sucess');
            return redirect()->route('admin.categories.index');
        }
        else{
            \Session::flash('flash_danger', 'record_failed');
            return redirect()->route('admin.categories.edit', $id);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!AdminController::isEmpty($category) && Category::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.categories.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Category::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
