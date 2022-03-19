<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\NoticesRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Notice;

class NoticesController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $notices = Notice::where('title', 'LIKE', '%'.Session::get("filter_notices_title").'%')->orderBy('date', 'desc');
        $notices->sortable();
        $count = $notices->count();

        return view('admin.notices.index', ['notices' => $notices->get(), 'count' => $count]);
    }

    public function create()
    {
        return view('admin.notices.add', ['notice' => new Notice(), 'status' => 'creating']);
    }

    public function store(NoticesRequest $request)
    {
        $items = $request->all();
        if (Input::has('link') && !preg_match('/http:\/\//', $request->get('link')) && !preg_match('/https:\/\//', $request->get('link')))
            $items['link'] = 'http://'.$items['link'];
        if(Notice::create($items)){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.notices.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.notices.create');
    }

    public function edit($id)
    {
        $notice = Notice::find($id);
        if(AdminController::isEmpty($notice))
            return redirect()->route('admin.notices.index');
        return view('admin.notices.edit', ['notice' => $notice, 'status' => 'editing']);
    }

    public function update(NoticesRequest $request, $id)
    {
        $notice = Notice::find($id);
        $notice['slug'] = null;
        $notice->fill($request->all());
        if (Input::has('link') && !preg_match('/http:\/\//', $request->get('link')) && !preg_match('/https:\/\//', $request->get('link')))
            $notice['link'] = 'http://'.$request->get('link');
        if(AdminController::isEmpty($notice))
            return redirect()->route('admin.notices.index');
        if ($notice->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.notices.index');
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);
        if($notices = Notice::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.notices.index');
    }

    public function noticeSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Notice::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
