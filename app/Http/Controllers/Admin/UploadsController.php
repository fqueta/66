<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UploadsRequest;
use App\Http\Controllers\Controller;
use App\Upload;

use Input;
use Session;

class UploadsController extends AdminController
{    
    public function index()
    {
        $this->saveSession(Input::all());
        $uploads = Upload::where('title', 'LIKE', '%'.Session::get("filter_uploads_title").'%');
        $count = $uploads->count();
        $uploads = $uploads->paginate(20);
        return view('admin.uploads.index', ['uploads' => $uploads, 'count' => $count]);
    }

    public function store(UploadsRequest $request)
    {
        $request = $request->all();
        if (!empty($request) && ($request = Upload::create($request)) ) {
            \Session::flash('flash_sucess', 'add_sucess');
            return redirect()->route('admin.file_uploads.index');
        } else
            return view('admin.uploads.add', [ 'uploads' => $request ]);
    }

    public function show($slug){
        $upload = Upload::findBySlug($slug);
        if($upload)
            return response()->download(public_path() . $upload->file->url('original'), $upload->title . "." . explode('/', $upload->file->contentType())[1]);
        else
            return redirect('admin.uploads.index');
    }

    public function destroy($id)
    {
        if (empty($upload = Upload::find($id))) {
            \Session::flash('flash_danger', 'invalid_record');
            return redirect()->route('admin.file_uploads.index');
        }

        if($upload->delete()) {
            \Session::flash('flash_sucess', 'record_deleted');
            return redirect()->route('admin.file_uploads.index');
        }
        else{
            \Session::flash('flash_danger', 'record_delete_failed');
            return redirect()->route('admin.file_uploads.index');
        }    
    }


    public function postSort(Request $request)
    {
        $order = 0;
        foreach ($request->get('featured_enterprises') as $key => $id) {
            Upload::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
