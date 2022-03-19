@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Banners | Novo banner',
		'class_icon' => 'ls-ico-images', 
		'breadcrumbs' => [
			['title' => 'Banners', 'url' => route('admin.banners.index')],
			['title' => 'Novo banner', 'url' => route('admin.banners.create')],
		]
	])

	@include('elements.admin.banners.form')
</div>
@stop