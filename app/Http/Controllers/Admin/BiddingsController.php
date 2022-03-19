<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\BiddingsRequest;

use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;

use App\Bidding;
use App\BiddingCategory;
use App\Phase;
use App\Genre;
use App\Type;
use App\Newsletter;
use App\Contact;

class BiddingsController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $biddings = Bidding::with('newsletters')->where('title', 'LIKE', '%'.Session::get("filter_biddings_title").'%')->orderBy('id', 'DESC');
        if(Input::has('filter_biddings_genre') && trim(Input::get('filter_biddings_genre')) !== "")
            $biddings = $biddings->where(['genre_id' => Input::get('filter_biddings_genre')]);
        if(Input::has('filter_biddings_phase') && trim(Input::get('filter_biddings_phase')) !== "")
            $biddings = $biddings->where(['phase_id' => Input::get('filter_biddings_phase')]);
        if(Input::has('filter_biddings_category') && trim(Input::get('filter_biddings_category')) !== "")
            $biddings = $biddings->where(['bidding_category_id' => Input::get('filter_biddings_category')]);
        $count = $biddings->count();
        $biddings = $biddings->paginate(20);

        return view('admin.biddings.index', [
            'biddings' => $biddings,
            'count' => $count,
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            'biddings_with_resgistry' => Newsletter::groupBy('bidding_id')->get()->lists('bidding_id')->toArray()
        ]);
    }

    public function create()
    {
        return view('admin.biddings.add', [
            'bidding' => new Bidding(),
            'status' => 'creating',
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
        ]);
    }

    public function store(BiddingsRequest $request)
    {
        $items = $request->except(['notification_check', 'opening']);
        //dd($request->all());
        $items['opening'] = Carbon::createFromFormat('d/m/Y H:i', $request->get('opening'));
        if($bidding = Bidding::create($items)){
            $receivers = Newsletter::where('bidding_category_id', $items['bidding_category_id'])->get()->lists('email')->toArray();
            //if(count($receivers))
                //Contact::sendMessage(["bidding" => $bidding, 'receiver' => $receivers, 'subject' => 'Nova licitação - Presidente Olegário'], 'email.new_bidding');
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.biddings.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.biddings.create');
    }

    public function edit($id)
    {
        $bidding = Bidding::find($id);
        if(AdminController::isEmpty($bidding))
            return redirect()->route('admin.biddings.index');
        return view('admin.biddings.edit', [
            'bidding' => $bidding,
            'status' => 'editing',
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
        ]);
    }

    public function update(BiddingsRequest $request, $id)
    {
        $bidding = Bidding::find($id);
        $items = $request->except(['notification_check', 'opening']);
        $items['opening'] = Carbon::createFromFormat('d/m/Y H:i', $request->get('opening'));
        $bidding->fill($items);
        if(AdminController::isEmpty($bidding))
            return redirect()->route('admin.biddings.index');
        if ($bidding->save()){
            if($request->get('notification_check')){
                $receivers = Newsletter::where('bidding_id', $id)->get()->lists('email')->toArray();
                Contact::sendMessage(["bidding" => $bidding, 'receiver' => $receivers, 'subject' => 'Edição na licitação - '.$bidding->title], 'email.new_bidding');
            }
            \Session::flash('flash_sucess', 'edit_sucess');
        }
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.biddings.index');
    }

    public function destroy($id)
    {
        $bidding = Bidding::find($id);
        if($biddings = Bidding::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.biddings.index');
    }

    // public function postSort()
    // {
    //     $order = 0;
    //     foreach (Input::get('featured_enterprises') as $key => $id) {
    //         Bidding::find($id)->update(['order' => $order]);
    //         $order++;
    //     }
    //     abort(200);
    // }
}
