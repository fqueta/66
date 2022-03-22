<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Btrimestral;
use App\BiddingCategory;
use App\Phase;
use App\Genre;

class BtrimestralsController extends Controller
{
    public function index(Request $request)
    {
        $limit = false;
        $page = 0;
        if($request->has('title') && trim($request->get('title')) !== ""){
            $biddings = Btrimestral::where('title', 'LIKE', '%'.$request->get("title").'%')->orderBy('opening', 'DESC');
            $biddings = $biddings->orWhere('object', 'LIKE', '%'.$request->get("title").'%');
        }else{
            $biddings = Btrimestral::orderBy('opening', 'DESC');
        }
        if($request->has('genre') && trim($request->get('genre')) !== "")
            $biddings = $biddings->where(['genre_id' => $request->get('genre')]);
        if($request->has('genre') && trim($request->get('genre')) !== "")
            $biddings = $biddings->where(['genre_id' => $request->get('genre')]);
        if($request->has('phase') && trim($request->get('phase')) !== "")
            $biddings = $biddings->where(['phase_id' => $request->get('phase')]);
        if($request->has('category') && trim($request->get('category')) !== "")
            $biddings = $biddings->where(['bidding_category_id' => $request->get('category')]);
        if($request->has('date_begin'))
            $biddings = $biddings->whereDate('opening', '>=', Carbon::createFromFormat('Y-m-d', $request->get("date_begin"))->toDateString() );
        if($request->has('date_end'))
            $biddings = $biddings->whereDate('opening', '<=', Carbon::createFromFormat('Y-m-d', $request->get("date_end"))->toDateString() );
        $count = $biddings->count();
        if($request->has('limit'))
            $limit = $request->get('limit');
        if($request->has('page'))
            $page = $request->get('page') - 1;
        if($limit)
            $biddings = $biddings->take($limit)->skip($limit * $page);

        $phases =  Phase::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $genres =  Genre::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $bidding_categories =  BiddingCategory::select(['id', 'name'])->orderBy('name', 'asc')->get();

        $biddings = $biddings->where(['active' => 1])
            ->orderBy('opening', 'desc')
            ->select(['id', 'title', 'opening', 'indentifier', 'object', 'genre_id', 'phase_id', 'bidding_category_id', 'created_at'])
            ->with('genre')
            ->with('phase')
            ->with('category')
            ->with('attachments')
            ->get();

        return [ "amount" => $count, 'biddings' => $biddings, 'phases' => $phases, 'genres' => $genres, 'bidding_categories' => $bidding_categories];
    }
}
