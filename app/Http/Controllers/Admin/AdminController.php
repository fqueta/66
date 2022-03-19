<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sofa\Eloquence\Eloquence;

use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use lluminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use Carbon\Carbon;

use Auth;

class AdminController extends Controller
{
    use Eloquence;
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
    }

    public function saveSession($inputs){
        foreach ($inputs as $key => $input) {
            $inputName = explode('_', $key);
            if($inputName[0] == 'filter'){
                Session::put($key, $input);
            }
        }
    }

    public function getDates($inputs){
        $dates = [];
        // dd(Carbon::create()->format('Y-m-d H:m:s'));
        $i = 0;
        foreach($inputs as $key => $input){
            $dates[$i] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d H:m:s');
            $i++;
        }
        return $dates;
    }

    static function isEmpty($items){
        if(empty($items)){
            \Session::flash('flash_danger', 'invalid_record');
            return true;
        }
    }
}
