<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;
use Route;

use App\Page;
use App\Post;

class HomeController extends Controller
{
    public function index()
    {
			$image = url('/prefeitura.jpg');
			$url = url();
			$title = "Prefeitura Municipal de Presidente Olegário";
			$description = "Presidente Olegário é um município brasileiro do estado de Minas Gerais. O município é composto por 4 distritos: a Sede, Galena, Santiago de Minas e Ponte Firme.";
			$uri = explode('/', $_SERVER['REQUEST_URI']);

    	if($uri[1] == 'p' && isset($uri[2]) && $page = Page::where(['slug' => $uri[2]])->first()){
				$url = url(implode('/', $uri));
				$title = "Prefeitura Municipal de Presidente Olegário - ".$page->title;
				$description = "Presidente Olegário é um município brasileiro do estado de Minas Gerais. O município é composto por 4 distritos: a Sede, Galena, Santiago de Minas e Ponte Firme.";
    	} else if($uri[1] == 'noticia' && isset($uri[2]) && $post = Post::where(['slug' => $uri[2]])->first()){
    		$image = url($post->image_preview->url('thumbnail'));
				$url = url(implode('/', $uri));
				$title = "Prefeitura Municipal de Presidente Olegário - ".$post->title;
				$description = $post->description;
    	}

      $meta = "
          <meta property=\"og:type\" content=\"website\">
          <meta property=\"og:image\" content=\"".$image."\">
          <meta property=\"og:url\" content=\"".$url."\">
          <meta property=\"og:title\" content=\"".$title."\">
          <meta property=\"og:locale\" content=\"pt_BR\">
          <meta property=\"og:site_name\" content=\"".url()."\">
          <meta property=\"og:description\" content=\"".$description."\">
          <meta property=\"fb:app_id\" content=\"265960177122371\">
      ";

    	$manifest = File::get(public_path() . '/build/asset-manifest.json');
      $manifest = json_decode($manifest, 1);
      return view('layout.react', ['manifest' => $manifest, 'meta' => $meta]);
    }
}
