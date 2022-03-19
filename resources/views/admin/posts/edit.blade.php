@extends('layout.admin')
@section('content')
<link rel="stylesheet" href="/admin_files/css/croppie.css" />
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Notícias | Editar notícia',
		'class_icon' => 'ls-ico-bullhorn', 
		'breadcrumbs' => [
			['title' => 'Notícias', 'url' => route('admin.posts.index')],
			['title' => 'Editar notícia', 'url' => route('admin.posts.edit')],
		]
	])

	@include('elements.admin.posts.form')
</div>
@stop