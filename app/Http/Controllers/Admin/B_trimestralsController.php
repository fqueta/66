<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\BtrimestralsRequest;

use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;

use App\BiddingCategory;
use App\Btrimestral;
use App\Phase;
use App\Genre;
use App\Type;
use App\Contact;


class B_trimestralsController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        //$biddings = Btrimestral::with('newsletters')->where('title', 'LIKE', '%'.Session::get("filter_biddings_title").'%')->orderBy('id', 'DESC');
        $biddings = Btrimestral::where('title', 'LIKE', '%'.Session::get("filter_biddings_title").'%')->orderBy('id', 'DESC');
        if(Input::has('filter_biddings_genre') && trim(Input::get('filter_biddings_genre')) !== "")
            $biddings = $biddings->where(['genre_id' => Input::get('filter_biddings_genre')]);
        if(Input::has('filter_biddings_phase') && trim(Input::get('filter_biddings_phase')) !== "")
            $biddings = $biddings->where(['phase_id' => Input::get('filter_biddings_phase')]);
        if(Input::has('filter_biddings_category') && trim(Input::get('filter_biddings_category')) !== "")
            $biddings = $biddings->where(['bidding_category_id' => Input::get('filter_biddings_category')]);
        $count = $biddings->count();
        $biddings = $biddings->paginate(20);

        return view('admin.b_trimestrals.index', [
            'biddings' => $biddings,
            'count' => $count,
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            //'biddings_with_resgistry' => Newsletter::groupBy('bidding_id')->get()->lists('bidding_id')->toArray()
        ]);
    }

    public function create()
    {
        return view('admin.b_trimestrals.add', [
            'bidding' => new Btrimestral(),
            'status' => 'creating',
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
        ]);
    }

    public function store(BtrimestralsRequest $request)
    {
        $items = $request->except(['notification_check', 'opening']);
        $op = explode( ' ', $request->get('opening'));
        if(!isset($op[1])){
            $opn = $request->get('opening').' '.date('H:i');
        }else{
            $opn = $request->get('opening');
        }
            
        $items['opening'] = Carbon::createFromFormat('d/m/Y H:i', $opn);
        //dd($items);
        if($bidding = Btrimestral::create($items)){
            //$receivers = Newsletter::where('bidding_category_id', $items['bidding_category_id'])->get()->lists('email')->toArray();
            //if(count($receivers))
                //Contact::sendMessage(["bidding" => $bidding, 'receiver' => $receivers, 'subject' => 'Nova licitação - Presidente Olegário'], 'email.new_bidding');
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.b_trimestrals.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.b_trimestrals.create');
    }

    public function edit($id)
    {
        $bidding = Btrimestral::find($id);
        if(AdminController::isEmpty($bidding))
            return redirect()->route('admin.b_trimestrals.index');
        return view('admin.b_trimestrals.edit', [
            'bidding' => $bidding,
            'status' => 'editing',
            'phases' => Phase::lists('name', 'id')->toArray(),
            'genres' => Genre::lists('name', 'id')->toArray(),
            'categories' => BiddingCategory::lists('name', 'id')->toArray(),
            'types' => Type::lists('name', 'id')->toArray(),
        ]);
    }

    public function update(BtrimestralsRequest $request, $id)
    {
        $bidding = Btrimestral::find($id);
        $items = $request->except(['notification_check', 'opening']);
        $items['opening'] = Carbon::createFromFormat('d/m/Y H:i', $request->get('opening'));
        $bidding->fill($items);
        if(AdminController::isEmpty($bidding))
            return redirect()->route('admin.b_trimestrals.index');
        if ($bidding->save()){
            if($request->get('notification_check')){
                $receivers = Newsletter::where('bidding_id', $id)->get()->lists('email')->toArray();
                Contact::sendMessage(["bidding" => $bidding, 'receiver' => $receivers, 'subject' => 'Edição na licitação - '.$bidding->title], 'email.new_bidding');
            }
            \Session::flash('flash_sucess', 'edit_sucess');
        }
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.b_trimestrals.index');
    }

    public function destroy($id)
    {
        $bidding = Btrimestral::find($id);
        if($biddings = Btrimestral::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.b_trimestrals.index');
    }

    // public function postSort()
    // {
    //     $order = 0;
    //     foreach (Input::get('featured_enterprises') as $key => $id) {
    //         Btrimestral::find($id)->update(['order' => $order]);
    //         $order++;
    //     }
    //     abort(200);
    // }
}
