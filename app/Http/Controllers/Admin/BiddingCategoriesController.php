<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiddingCategoriesRequest;

use App\BiddingCategory;

use Input;
use Session;

class BiddingCategoriesController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());
        $bidding_categories = BiddingCategory::where('name', 'LIKE', '%'.Session::get("filter_bidding_categories_name").'%');
        $count = $bidding_categories->count();
        $bidding_categories = $bidding_categories->paginate(20);
        return view('admin.bidding_categories.index', ['bidding_categories' => $bidding_categories, 'count' => $count]);
    }

    public function create()
    {
        return view('admin.bidding_categories.add', ['bidding_category' => new BiddingCategory()]);
    }

    public function store(BiddingCategoriesRequest $request)
    {
        $items = $request->all();
        if (BiddingCategory::create($items)) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.bidding_categories.index');
        } else
            Session::flash('flash_warnig', 'record_failed');
            return view('admin.bidding_categories.add');
    }

    public function edit($id)
    {
        $bidding_category = BiddingCategory::find($id);
        if(AdminController::isEmpty($bidding_category))
            return redirect()->route('admin.bidding_categories.index');
        return view('admin.bidding_categories.edit', ['bidding_category' => $bidding_category]);
    }

    public function update(BiddingCategoriesRequest $request, $id)
    {
        $bidding_category = BiddingCategory::find($id);
        $bidding_category->fill($request->all());
        if(AdminController::isEmpty($bidding_category))
            return redirect()->route('admin.bidding_categories.index');
        if (!AdminController::isEmpty($bidding_category) && $bidding_category->save()){
            \Session::flash('flash_sucess', 'edit_sucess');
            return redirect()->route('admin.bidding_categories.index');
        }
        else{
            \Session::flash('flash_danger', 'record_failed');
            return redirect()->route('admin.bidding_categories.edit', $id);
        }
    }

    public function destroy($id)
    {
        $bidding_category = BiddingCategory::find($id);
        if(!AdminController::isEmpty($bidding_category) && BiddingCategory::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.bidding_categories.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            BiddingCategory::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
