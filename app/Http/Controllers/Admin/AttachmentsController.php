<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AttachmentsRequest;
use App\Http\Controllers\Controller;
use App\Attachment;
use App\Bidding;

class AttachmentsController extends Controller
{    
	public function index($parent_id)
	{
		if ($parent = Bidding::find($parent_id)) {
			dd($parent->attachments);
			return view('admin.attachments.index', [
				'parent_page' => $parent,
				'attachments' => $parent->attachments,
			]);
		}
		else
			return redirect()->route('admin.biddings.index');
	}
	
	public function create($parent_id)
	{
		if ($parent = Bidding::find($parent_id))
			return view('admin.attachments.add', ['parent_page' => $parent, 'attachments' => new Attachment(), 'status' => 'creating']);
		else
			return redirect()->route('admin.biddings.index');
	}
	
	public function store($parent_id, AttachmentsRequest $request)
	{
		$request = $request->all();
		if (!empty($request) && ($request = Attachment::create($request)) ) {
			\Session::flash('flash_sucess', 'add_sucess');
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
		} else
			return view('admin.attachments.add', ['parent_page' => Attachment::find($parent_id), 'attachments' => $request]);
	}

	public function edit($parent_id, $id)
	{
		if ($request = Attachment::find($id))
			return view('admin.attachments.edit', ['parent_page' => $request->parent, 'attachments' => $request, 'status' => 'editing']);
		else
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
	}

	public function update(AttachmentsRequest $request, $parent_id, $id)
	{

		if(empty($attachment = Attachment::find($id))) {
			\Session::flash('flash_danger', 'invalid_record');
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
		}
		else {
			$attachment->fill($request->all());
			$attachment->slug = null;
			if ($attachment->save()) {
				\Session::flash('flash_sucess', 'edit_sucess');
				return redirect()->route('admin.biddings.attachments.index', $parent_id);
			}
			else {
				\Session::flash('flash_danger', 'record_failed');
				return view('admin.attachments.edit', [
					'parent_page' => $attachment->parent,
					'attachments' => $attachment
				]);
			}
		}
	}

	public function destroy($parent_id, $id)
	{
		if (empty($attachment = Attachment::find($id))) {
			\Session::flash('flash_danger', 'invalid_record');
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
		}

		if($attachment->delete()) {
			\Session::flash('flash_sucess', 'record_deleted');
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
		}
		else{
			\Session::flash('flash_danger', 'record_delete_failed');
			return redirect()->route('admin.biddings.attachments.index', $parent_id);
		}    
	}


    public function postSort(Request $request)
    {
        $order = 0;
        foreach ($request->get('featured_enterprises') as $key => $id) {
            Attachment::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
