<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PlayersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\Player;

class PlayersController extends AdminController
{
    public function index()
    {
        $this->saveSession(Input::all());

        $players = Player::orderBy('order', 'ASC')
            ->sortable();

        $count = $players->count();
        return view('admin.players.index', ['players' => $players->get(), 'count' => $count]);
    }

    public function create()
    {
        return view('admin.players.add', ['player' => new Player(), 'status' => 'creating']);
    }

    public function store(PlayersRequest $request)
    {
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        if (Input::has('copyright_link') && empty(parse_url($items['copyright_link'])['scheme']))
            $items['copyright_link'] = 'http://' . ltrim($items['copyright_link'], '/');
        $player = new Player();
        $player->fill($items);
        if($player->save()){
            Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.players.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.players.create');
    }

    public function edit($id)
    {
        $player = Player::find($id);
        if(AdminController::isEmpty($player))
            return redirect()->route('admin.players.index');
        return view('admin.players.edit', ['player' => $player, 'status' => 'editing']);
    }

    public function update(PlayersRequest $request, $id)
    {
        $player = Player::find($id);
        $items = $request->all();
        if (Input::has('link') && empty(parse_url($items['link'])['scheme']))
            $items['link'] = 'http://' . ltrim($items['link'], '/');
        if (Input::has('copyright_link') && empty(parse_url($items['copyright_link'])['scheme']))
            $items['copyright_link'] = 'http://' . ltrim($items['copyright_link'], '/');
        $player->fill($items);
        if(AdminController::isEmpty($player))
            return redirect()->route('admin.players.index');
        if ($player->save())
            \Session::flash('flash_sucess', 'edit_sucess');
        else
            \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.players.index');
    }

    public function destroy($id)
    {
        $player = Player::find($id);
        if($players = Player::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.players.index');
    }

    public function postSort()
    {
        $order = 0;
        foreach (Input::get('featured_enterprises') as $key => $id) {
            Player::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
