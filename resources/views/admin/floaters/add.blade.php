@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Floaters | Novo floater',
		'class_icon' => 'ls-ico-images', 
		'breadcrumbs' => [
			['title' => 'Floaters', 'url' => route('admin.floaters.index')],
			['title' => 'Novo floater', 'url' => route('admin.floaters.create')],
		]
	])

	@include('elements.admin.floaters.form')
</div>
@stop