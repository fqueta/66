<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\FloatersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Floater;

class FloatersController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $floaters = Floater::where('name', 'LIKE', '%'.Session::get("filter_floaters_name").'%')
            ->orderBy('order', 'ASC');

        $count = $floaters->count();
        return view('admin.floaters.index', ['floaters' => $floaters->get(), 'count' => $count]);
    }

    public function create()
    {
        return view('admin.floaters.add', ['floater' => new Floater(), 'status' => 'creating']);
    }

    public function store(FloatersRequest $request)
    {
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        $floater = new Floater();
        $floater->fill($items);
        if($floater->save()){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.floaters.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.floaters.create');
    }

    public function edit($id)
    {
        $floater = Floater::find($id);
        if(AdminController::isEmpty($floater))
            return redirect()->route('admin.floaters.index');
        return view('admin.floaters.edit', ['floater' => $floater, 'status' => 'editing']);
    }

    public function update(FloatersRequest $request, $id)
    {
        $floater = Floater::find($id);
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        $floater->fill($items);
        if(AdminController::isEmpty($floater))
            return redirect()->route('admin.floaters.index');
        if ($floater->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.floaters.index');
    }

    public function destroy($id)
    {
        $floater = Floater::find($id);
        if($floaters = Floater::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.floaters.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Floater::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
