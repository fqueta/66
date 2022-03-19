<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\NewslettersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Newsletter;
use App\BiddingCategory;
use App\Bidding;
use App\Phase;
use App\Genre;

class NewslettersController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $newsletters = Newsletter::where('name', 'LIKE', '%'.Session::get("filter_newsletters_name").'%')->where('bidding_category_id', '!=', 0);
        if(Input::has('filter_newsletters_category') && trim(Input::get('filter_newsletters_category')) !== "")
            $newsletters = $newsletters->where(['bidding_category_id' => Input::get('filter_newsletters_category')]);
        $count = $newsletters->count();
        $newsletters = $newsletters->paginate(20);
        return view('admin.newsletters.index', ['newsletters' => $newsletters, 'count' => $count, 'biddings' => Bidding::lists('title', 'id')->toArray(), 'categories' => BiddingCategory::lists('name', 'id')->toArray()]);
    }

    public function create()
    {
        return view('admin.newsletters.add', ['newsletter' => new Newsletter(), 'status' => 'creating', 'biddings' => Bidding::lists('title', 'id')->toArray(), 'categories' => BiddingCategory::lists('name', 'id')->toArray(), 'notification_type' => 'category']);
    }

    public function store(NewslettersRequest $request)
    {
        if($request->get('type') == 'bidding')
            $items = $request->except(['bidding_category_id', 'type']);
        else
            $items = $request->except(['bidding_id', 'type']);
        if(Newsletter::create($items)){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.newsletters.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.newsletters.create');
    }

    public function edit($id)
    {
        $newsletter = Newsletter::find($id);
        if(AdminController::isEmpty($newsletter))
            return redirect()->route('admin.newsletters.index');
        return view('admin.newsletters.edit', ['newsletter' => $newsletter, 'status' => 'editing', 'biddings' => Bidding::lists('title', 'id')->toArray(), 'categories' => BiddingCategory::lists('name', 'id')->toArray(), 'notification_type' => $newsletter->getType()]);
    }

    public function update(NewslettersRequest $request, $id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->fill($request->except(['type']));
        if($request->get('type') == 'bidding')
            $newsletter->bidding_category_id = null;
        else
            $newsletter->bidding_id = null;
        if(AdminController::isEmpty($newsletter))
            return redirect()->route('admin.newsletters.index');
        if ($newsletter->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.newsletters.index');
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        if($newsletters = Newsletter::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.newsletters.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Newsletter::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
