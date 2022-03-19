<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\NewslettersRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Newsletter;

class NewslettersController extends Controller
{
    public function store(NewslettersRequest $request)
    {
        if($request->get('bidding_id'))
            $itens = $request->except(['bidding_category_id']);
        else
            $itens = $request->except(['bidding_id']);
        if($newsletter = Newsletter::create($itens))
            return "OK";
        abort(500);
    }
}
