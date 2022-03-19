@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Notícias | Nova noticía',
		'class_icon' => 'ls-ico-bullhorn', 
		'breadcrumbs' => [
			['title' => 'Notícias', 'url' => route('admin.posts.index')],
			['title' => 'Nova noticía', 'url' => route('admin.posts.create')],
		]
	])

	@include('elements.admin.posts.form')
</div>
@stop