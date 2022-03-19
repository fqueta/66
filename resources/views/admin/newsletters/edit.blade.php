@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Recebimento de notificações | Editar cadastro',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações - Recebimento de notificações', 'url' => route('admin.newsletters.index')],
			['title' => 'Editar cadastro', 'url' => route('admin.newsletters.edit')],
		]
	])

	@include('elements.admin.newsletters.form')
</div>
@stop