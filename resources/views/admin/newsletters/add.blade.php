@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Recebimento de notificações | Novo cadastro',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações - Recebimento de notificações', 'url' => route('admin.newsletters.index')],
			['title' => 'Novo cadastro', 'url' => route('admin.newsletters.create')],
		]
	])

	@include('elements.admin.newsletters.form')
</div>
@stop