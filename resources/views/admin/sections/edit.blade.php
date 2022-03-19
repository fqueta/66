@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Fale conosco - Secretarias | Editar secretaria',
		'class_icon' => 'ls-ico-user', 
		'breadcrumbs' => [
			['title' => 'Fale conosco - Secretarias', 'url' => route('admin.sections.index')],
			['title' => 'Editar secretaria', 'url' => route('admin.sections.edit')],
		]
	])

	@include('elements.admin.sections.form')
</div>
@stop