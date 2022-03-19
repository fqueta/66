<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\NotificationsRequest;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Bidding;
use App\Contact;
use App\Newsletter;

class NotificationsController extends Controller
{    
    public function index($parent_id)
    {
        if ($parent = Bidding::find($parent_id))
            return view('admin.notifications.index', ['parent_page' => $parent, 'notifications' => $parent->notifications]);
        else
            return redirect()->route('admin.biddings.index');
    }
    
    public function create($parent_id)
    {
        if ($parent = Bidding::find($parent_id))
            return view('admin.notifications.add', ['parent_page' => $parent, 'notifications' => new Notification(), 'status' => 'creating']);
        else
            return redirect()->route('admin.biddings.index');
    }
    
    public function store($parent_id, NotificationsRequest $request)
    {
        $request = $request->all();
        if (!empty($request) && ($request = Notification::create($request)) ) {
            $parent = Bidding::find($parent_id);
            $receivers = Newsletter::where('bidding_id', $parent_id)->get()->lists('email')->toArray();
            Contact::sendMessage(["bidding" => $request, 'receiver' => $receivers, 'parent' => $parent, 'subject' => 'Licitação ' . $parent->indentifier . ' atualizada'], 'email.new_notification');

            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.biddings.notifications.index', $parent_id);
        } else
            return view('admin.notifications.add', ['parent_page' => Notification::find($parent_id), 'notifications' => $request]);
    }

    public function destroy($parent_id, $id)
    {
        if (empty($notification = Notification::find($id))) {
            \Session::flash('flash_danger', 'invalid_record');
            return redirect()->route('admin.biddings.notifications.index', $parent_id);
        }

        if($notification->delete()) {
            \Session::flash('flash_sucess', 'record_deleted');
            return redirect()->route('admin.biddings.notifications.index', $parent_id);
        }
        else{
            \Session::flash('flash_danger', 'record_delete_failed');
            return redirect()->route('admin.biddings.notifications.index', $parent_id);
        }    
    }


    public function postSort(Request $request)
    {
        $order = 0;
        foreach ($request->get('featured_enterprises') as $key => $id) {
            Notification::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
