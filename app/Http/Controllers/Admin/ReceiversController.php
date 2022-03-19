<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiversRequest;

use App\Receiver;
use App\Section;

use Input;
use Session;

class ReceiversController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());
        $receivers = Receiver::where('name', 'LIKE', '%'.Session::get("filter_receivers_name").'%')
            ->where('email', 'LIKE', '%'.Session::get("filter_receivers_email").'%');
        $receivers->sortable();
        $count = $receivers->count();
        $receivers = $receivers->paginate(20);
        return view('admin.receivers.index', ['receivers' => $receivers, 'count' => $count, 'sections' => Section::lists('name', 'id')]);
    }

    public function create()
    {
        return view('admin.receivers.add', ['receiver' => new Receiver(), 'sections' => Section::lists('name', 'id')]);
    }

    public function store(ReceiversRequest $request)
    {
        $items = $request->all();
        if (Receiver::create($items)) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.receivers.index');
        } else
            Session::flash('flash_warnig', 'record_failed');
            return view('admin.receivers.add');
    }

    public function edit($id)
    {
        $receiver = Receiver::find($id);
        if(AdminController::isEmpty($receiver))
            return redirect()->route('admin.receivers.index');
        return view('admin.receivers.edit', ['receiver' => $receiver, 'sections' => Section::lists('name', 'id')]);
    }

    public function update(ReceiversRequest $request, $id)
    {
        $receiver = Receiver::find($id);
        $receiver->fill($request->all());
        if(AdminController::isEmpty($receiver))
            return redirect()->route('admin.receivers.index');
        if (!AdminController::isEmpty($receiver) && $receiver->save()){
            \Session::flash('flash_sucess', 'edit_sucess');
            return redirect()->route('admin.receivers.index');
        }
        else{
            \Session::flash('flash_danger', 'record_failed');
            return redirect()->route('admin.receivers.edit', $id);
        }
    }

    public function destroy($id)
    {
        $receiver = Receiver::find($id);
        if(!AdminController::isEmpty($receiver) && Receiver::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.receivers.index');
    }

    public function download($id){
        $receiver = Receiver::find($id);
        return response()->download($receiver->receiver_file->path());
    }
}
