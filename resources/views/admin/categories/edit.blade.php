@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Categorias | Editar categoria',
		'class_icon' => 'ls-ico-list2', 
		'breadcrumbs' => [
			['title' => 'Categorias', 'url' => route('admin.categories.index')],
			['title' => 'Editar categoria', 'url' => route('admin.categories.edit')],
		]
	])

	@include('elements.admin.categories.form')
</div>
@stop