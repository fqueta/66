<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Player;

class PlayersController extends Controller
{
    public function index()
    {
      return Player::where('active', true)->orderBy('order', 'asc')->select(['id', 'button_text', 'copyright_link', 'copyright_name', 'description', 'desktop_file_name', 'link', 'mobile_file_name', 'title', 'target'])->get();
    }
}
