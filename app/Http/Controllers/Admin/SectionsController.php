<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionsRequest;

use App\Section;

use Input;
use Session;

class SectionsController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());
        $sections = Section::where('name', 'LIKE', '%'.Session::get("filter_sections_name").'%');
        $count = $sections->count();
        $sections = $sections->paginate(20);
        return view('admin.sections.index', ['sections' => $sections, 'count' => $count]);
    }

    public function create()
    {
        return view('admin.sections.add', ['section' => new Section()]);
    }

    public function store(SectionsRequest $request)
    {
        $items = $request->all();
        if (Section::create($items)) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.sections.index');
        } else
            Session::flash('flash_warnig', 'record_failed');
            return view('admin.sections.add');
    }

    public function edit($id)
    {
        $section = Section::find($id);
        if(AdminController::isEmpty($section))
            return redirect()->route('admin.sections.index');
        return view('admin.sections.edit', ['section' => $section]);
    }

    public function update(SectionsRequest $request, $id)
    {
        $section = Section::find($id);
        $section->fill($request->all());
        if(AdminController::isEmpty($section))
            return redirect()->route('admin.sections.index');
        if (!AdminController::isEmpty($section) && $section->save()){
            \Session::flash('flash_sucess', 'edit_sucess');
            return redirect()->route('admin.sections.index');
        }
        else{
            \Session::flash('flash_danger', 'record_failed');
            return redirect()->route('admin.sections.edit', $id);
        }
    }

    public function destroy($id)
    {
        $section = Section::find($id);
        if(!AdminController::isEmpty($section) && Section::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.sections.index');
    }

    public function download($id){
        $section = Section::find($id);
        return response()->download($section->section_file->path());
    }
}
