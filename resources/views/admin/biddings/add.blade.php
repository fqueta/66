@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Processos | Nova processo',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações - Processos', 'url' => route('admin.biddings.index')],
			['title' => 'Nova processo', 'url' => route('admin.biddings.create')],
		]
	])

	@include('elements.admin.biddings.form')
</div>
@stop