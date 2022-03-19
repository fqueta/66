@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Comunicados | Editar comunicado',
		'class_icon' => 'ls-ico-bullhorn',
		'breadcrumbs' => [
			['title' => 'Comunicados', 'url' => route('admin.notices.index')],
			['title' => 'Editar comunicado', 'url' => route('admin.notices.edit')],
		]
	])

	@include('elements.admin.notices.form')
</div>
@stop
