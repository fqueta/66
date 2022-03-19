@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Slider | Editar item do slider',
		'class_icon' => 'ls-ico-images', 
		'breadcrumbs' => [
			['title' => 'Slider', 'url' => route('admin.players.index')],
			['title' => 'Editar item do slider', 'url' => route('admin.players.edit')],
		]
	])

	@include('elements.admin.players.form')
</div>
@stop