<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Http\Controllers\Controller;
use App\Page;

class SubpagesController extends Controller
{    
    public function index($page_id)
    {
        if ($page = Page::find($page_id)) {
            return view('admin.subpages.index', [
                'parent_page' => $page,
                'pages' => $page->subpages,
                'types' => ['content' => 'Conteúdo', 'link' => 'Link'],
            ]);
        }
        else
            return redirect()->route('admin.pages.index');
    }
    
    public function create($page_id)
    {
        if ($page = Page::find($page_id))
            return view('admin.subpages.add', ['parent_page' => $page, 'page' => new Page(), 'status' => 'creating']);
        else
            return redirect()->route('admin.pages.index');
    }
    
    public function store($page_id, PagesRequest $request)
    {
        $page = $request->all();
        if (!empty($page) && ($page = Page::create($page)) ) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.pages.subpages.index', $page_id);
        } else
            return view('admin.subpages.add', ['parent_page' => Page::find($page_id), 'page' => $page]);
    }

    public function edit($page_id, $id)
    {
        if ($page = Page::find($id))
            return view('admin.subpages.edit', ['parent_page' => $page->parent, 'page' => $page, 'status' => 'editing']);
        else
            return redirect()->route('admin.pages.subpages.index', $page_id);
    }

    public function update(PagesRequest $request, $page_id, $id)
    {

        if(empty($page = Page::find($id))) {
            \Session::flash('flash_danger', 'invalid_record');
            return redirect()->route('admin.pages.subpages.index', $page_id);
        }
        else {
            $page->fill($request->all());
            $page->slug = null;
            if ($page->save()) {
                \Session::flash('flash_sucess', 'edit_sucess');
                return redirect()->route('admin.pages.subpages.index', $page_id);
            }
            else {
                \Session::flash('flash_danger', 'record_failed');
                return view('admin.subpages.edit', [
                    'parent_page' => $page->parent,
                    'page' => $page
                ]);
            }
        }
    }

    public function destroy($page_id, $id)
    {
        if (empty($page = Page::find($id))) {
            \Session::flash('flash_danger', 'invalid_record');
            return redirect()->route('admin.pages.subpages.index', $page_id);
        }

        if($page->delete()) {
            \Session::flash('flash_sucess', 'record_deleted');
            return redirect()->route('admin.pages.subpages.index', $page_id);
        }
        else{
            \Session::flash('flash_danger', 'record_delete_failed');
            return redirect()->route('admin.pages.subpages.index', $page_id);
        }    
    }
}
