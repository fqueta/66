<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\BannersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Banner;

use Parsedown;

class BannersController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $banners = Banner::orderBy('order', 'ASC');

        $count = $banners->count();

        $Parsedown = new Parsedown();

        return view('admin.banners.index', ['banners' => $banners->get(), 'count' => $count, 'parse' => $Parsedown]);
    }

    public function create()
    {
        return view('admin.banners.add', ['banner' => new Banner(), 'status' => 'creating']);
    }

    public function store(BannersRequest $request)
    {
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        $banner = new Banner();
        $banner->fill($items);
        if($banner->save()){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.banners.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.banners.create');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        if(AdminController::isEmpty($banner))
            return redirect()->route('admin.banners.index');
        return view('admin.banners.edit', ['banner' => $banner, 'status' => 'editing']);
    }

    public function update(BannersRequest $request, $id)
    {
        $banner = Banner::find($id);
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        $banner->fill($items);
        if(AdminController::isEmpty($banner))
            return redirect()->route('admin.banners.index');
        if ($banner->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.banners.index');
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        if($banners = Banner::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.banners.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Banner::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
