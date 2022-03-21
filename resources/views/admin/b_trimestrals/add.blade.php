@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Processos Trimestrais | Nova processo',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações Trimestrais - Processos', 'url' => route('admin.b_trimestrals.index')],
			['title' => 'Nova processo trimestral', 'url' => route('admin.b_trimestrals.create')],
		]
	])

	@include('elements.admin.b_trimestrals.form')
</div>
@stop