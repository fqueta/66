@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Páginas | Nova página',
		'class_icon' => 'ls-ico-bullhorn', 
		'breadcrumbs' => [
			['title' => 'Páginas', 'url' => route('admin.pages.index')],
			['title' => 'Nova página', 'url' => route('admin.pages.create')],
		]
	])

	@include('elements.admin.pages.form')
</div>
@stop