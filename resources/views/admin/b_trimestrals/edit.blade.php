@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações trimestrais - Processos | Editar processo',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações trimestrais - Processos', 'url' => route('admin.b_trimestrals.index')],
			['title' => 'Editar processo', 'url' => route('admin.b_trimestrals.edit')],
		]
	])

	@include('elements.admin.b_trimestrals.form')
</div>
@stop