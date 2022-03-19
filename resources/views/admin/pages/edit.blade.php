@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Páginas | Editar página',
		'class_icon' => 'ls-ico-bullhorn', 
		'breadcrumbs' => [
			['title' => 'Páginas', 'url' => route('admin.pages.index')],
			['title' => 'Editar página', 'url' => route('admin.pages.edit')],
		]
	])

	@include('elements.admin.pages.form')
</div>
@stop