@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Categorias | Nova categoria',
		'class_icon' => 'ls-ico-list2', 
		'breadcrumbs' => [
			['title' => 'Categorias', 'url' => route('admin.categories.index')],
			['title' => 'Nova categoria', 'url' => route('admin.categories.create')],
		]
	])

	@include('elements.admin.categories.form')
</div>
@stop