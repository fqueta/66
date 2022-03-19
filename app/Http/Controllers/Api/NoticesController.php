<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notice;
use Carbon\Carbon;

class NoticesController extends Controller
{
    public function index(Request $request) {
        return ['notices' => Notice::active()->get()];
    }
}
