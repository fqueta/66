<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PagesRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Page;

class PagesController extends AdminController
{
    public $types = ['content' => 'Conteúdo', 'menu' => 'Menu', 'link' => 'Link'];

    public function index()
    {
        $this->saveSession(Input::all());

        $pages = Page::where(['page_id' => 0])->where('title', 'LIKE', '%'.Session::get("filter_pages_title").'%')->orderBy('order', 'ASC');
        if(Input::has("filter_pages_type") && trim(Session::get("filter_pages_type")) !== "")
            $pages = $pages->where(['type' => Session::get("filter_pages_type")]);
        $pages->sortable();
        $count = $pages->count();
        return view('admin.pages.index', ['pages' => $pages->get(), 'count' => $count, 'types' => $this->types]);
    }

    public function create()
    {
        return view('admin.pages.add', ['page' => new Page(), 'status' => 'creating', 'types' => $this->types]);
    }

    public function store(PagesRequest $request)
    {
        $items = $request->all();
        if(Page::create($items)){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.pages.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.pages.create');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        if(AdminController::isEmpty($page))
            return redirect()->route('admin.pages.index');
        return view('admin.pages.edit', ['page' => $page, 'status' => 'editing', 'types' => $this->types]);
    }

    public function update(PagesRequest $request, $id)
    {
        $page = Page::find($id);
        $page['slug'] = null;
        $page->fill($request->all());
        if(AdminController::isEmpty($page))
            return redirect()->route('admin.pages.index');
        if ($page->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.pages.index');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        if($pages = Page::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.pages.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Page::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
