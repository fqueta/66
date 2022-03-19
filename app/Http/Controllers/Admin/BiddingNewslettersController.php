<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\BiddingNewslettersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Newsletter;
use App\BiddingCategory;
use App\Bidding;
use App\Phase;
use App\Genre;

class BiddingNewslettersController extends AdminController
{
    public function index($parent_id)
    {
        $this->saveSession(Input::all());
        if ($parent = Bidding::find($parent_id)){
            $newsletters = Newsletter::where('name', 'LIKE', '%'.Session::get("filter_newsletters_name").'%')->where(['bidding_id' => $parent_id]);
            $count = $newsletters->count();
            $newsletters = $newsletters->paginate(20);
            return view('admin.bidding_newsletters.index', ['parent_page' => $parent, 'newsletters' => $newsletters, 'count' => $count, 'biddings' => Bidding::find($parent_id)]);
        } 
        else
            return redirect()->route('admin.biddings.index');
    }

    public function destroy($parent_id, $id)
    {
        if (empty($newsletter = Newsletter::find($id))) {
            \Session::flash('flash_danger', 'invalid_record');
            return redirect()->route('admin.biddings.newsletters.index', $parent_id);
        }

        if($newsletter->delete()) {
            \Session::flash('flash_sucess', 'record_deleted');
            return redirect()->route('admin.biddings.newsletters.index', $parent_id);
        }
        else{
            \Session::flash('flash_danger', 'record_delete_failed');
            return redirect()->route('admin.biddings.newsletters.index', $parent_id);
        }  
    }
}
