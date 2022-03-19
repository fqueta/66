@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Banners | Editar banner',
		'class_icon' => 'ls-ico-images', 
		'breadcrumbs' => [
			['title' => 'Banners', 'url' => route('admin.banners.index')],
			['title' => 'Editar banner', 'url' => route('admin.banners.edit')],
		]
	])

	@include('elements.admin.banners.form')
</div>
@stop