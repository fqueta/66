<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Diary;

class DiariesController extends Controller
{
    public function index(Request $request)
    {   
        $limit = false;
        $page = 0;
        if($request->has('only_dates'))
            return Diary::select(['date'])->lists('date');
        $diary = Diary::select(['description', 'date', 'file_file_name', 'file_file_size', 'link', 'id', 'code'])->orderBy('code', 'desc');
        if($request->has('description'))
            $diaries = $diary->where('description', 'LIKE', '%'.$request->get("description").'%');
        if($request->has('code'))
            $diaries = $diary->where('code', '=', $request->get("code"));
        if($request->has('date_begin'))
            $diaries = $diary->whereDate('date', '>=', Carbon::createFromFormat('Y-m-d', $request->get("date_begin"))->toDateString() );
        if($request->has('date_end'))
            $diaries = $diary->whereDate('date', '<=', Carbon::createFromFormat('Y-m-d', $request->get("date_end"))->toDateString() );
        $count = $diary->count();
        if($request->has('limit'))
            $limit = $request->get('limit');
        if($request->has('page'))
            $page = $request->get('page') - 1;
        if($limit)
            $diaries = $diary->take($limit)->skip($limit * $page);

        return [ "amount" => $count, "data" => $diary->get()];
    }
}
