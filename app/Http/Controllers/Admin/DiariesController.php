<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\DiariesRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Diary;

class DiariesController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $diaries = Diary::where('description', 'LIKE', '%'.Session::get("filter_diaries_description").'%')->orderBy('date', 'desc');
        $diaries->sortable();
        $count = $diaries->count();
        $diaries = $diaries->paginate(20);

        return view('admin.diaries.index', ['diaries' => $diaries, 'count' => $count]);
    }

    public function create()
    {
        $diary = new Diary();
        $diary->fill(['description' => "Confira no Diário Eletrônico os Atos Oficiais do Município."]);
        return view('admin.diaries.add', ['diary' => $diary, 'status' => 'creating']);
    }

    public function store(DiariesRequest $request)
    {
        $items = $request->all();
        if(Diary::create($items)){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.diaries.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.diaries.create');
    }

    public function edit($id)
    {
        $diary = Diary::find($id);
        if(AdminController::isEmpty($diary))
            return redirect()->route('admin.diaries.index');
        return view('admin.diaries.edit', ['diary' => $diary, 'status' => 'editing']);
    }

    public function update(DiariesRequest $request, $id)
    {
        $diary = Diary::find($id);
        $diary->fill($request->all());
        if(AdminController::isEmpty($diary))
            return redirect()->route('admin.diaries.index');
        if ($diary->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.diaries.index');
    }

    public function destroy($id)
    {
        $diary = Diary::find($id);
        if($diaries = Diary::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.diaries.index');
    }
}
