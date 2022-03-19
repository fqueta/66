<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Project;

class MetaTagsController extends Controller
{
    public function p(Request $request, $id)
    {
        $project = Project::where(['slug' => $id])->first();
        $meta = "
            <meta property=\"og:type\" content=\"website\">
            <meta property=\"og:image\" content=\"http://po.mg.gov.br{$project->image->url()}\">
            <meta property=\"og:url\" content=\"http://po.mg.gov.br/cases/{$project->slug}\">
            <meta property=\"og:title\" content=\"{$project->title}\">
            <meta property=\"og:locale\" content=\"pt_BR\">
            <meta property=\"og:site_name\" content=\"po.mg.gov.br\">
            <meta property=\"og:description\" content=\"{$project->description}\">
            <meta property=\"fb:app_id\" content=\"265960177122371\">
        ";

        return json_encode($meta, true);
    }

    public function noticia(Request $request, $id)
    {
        $post = Post::where(['slug' => $id])->first();
        $meta = "
            <meta property=\"og:type\" content=\"website\">
            <meta property=\"og:image\" content=\"http://po.mg.gov.br{$post->image->url()}\">
            <meta property=\"og:url\" content=\"http://po.mg.gov.br/imprensa/{$post->slug}\">
            <meta property=\"og:title\" content=\"{$post->title}\">
            <meta property=\"og:locale\" content=\"pt_BR\">
            <meta property=\"og:site_name\" content=\"po.mg.gov.br\">
            <meta property=\"og:description\" content=\"{$post->description}\">
            <meta property=\"fb:app_id\" content=\"265960177122371\">
        ";

        return json_encode($meta, true);
    }

    public function any()
    {
        $meta = "
            <meta property=\"og:type\" content=\"website\">
            <meta property=\"og:image\" content=\"{ url('/prefeitura.jpg') }\">
            <meta property=\"og:url\" content=\"{ url() }\">
            <meta property=\"og:title\" content=\"Prefeitura Municipal de Presidente Olegário\">
            <meta property=\"og:locale\" content=\"pt_BR\">
            <meta property=\"og:site_name\" content=\"po.mg.gov.br\">
            <meta property=\"og:description\" content=\"Presidente Olegário é um município brasileiro do estado de Minas Gerais. O município é composto por 4 distritos: a Sede, Galena, Santiago de Minas e Ponte Firme.\">
            <meta property=\"fb:app_id\" content=\"265960177122371\">
        ";
        return json_encode($meta, true);
    }
}
