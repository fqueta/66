@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Floaters | Editar floater',
		'class_icon' => 'ls-ico-images', 
		'breadcrumbs' => [
			['title' => 'Floaters', 'url' => route('admin.floaters.index')],
			['title' => 'Editar floater', 'url' => route('admin.floaters.edit')],
		]
	])

	@include('elements.admin.floaters.form')
</div>
@stop