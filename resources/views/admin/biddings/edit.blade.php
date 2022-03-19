@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Processos | Editar processo',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações - Processos', 'url' => route('admin.biddings.index')],
			['title' => 'Editar processo', 'url' => route('admin.biddings.edit')],
		]
	])

	@include('elements.admin.biddings.form')
</div>
@stop