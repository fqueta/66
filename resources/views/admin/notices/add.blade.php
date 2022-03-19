@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Comunicados | Novo comunicado',
		'class_icon' => 'ls-ico-bullhorn',
		'breadcrumbs' => [
			['title' => 'Comunicados', 'url' => route('admin.notices.index')],
			['title' => 'Novo comunicado', 'url' => route('admin.notices.create')],
		]
	])

	@include('elements.admin.notices.form')
</div>
@stop
