@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Fale conosco - Secretarias | Nova secretaria',
		'class_icon' => 'ls-ico-user', 
		'breadcrumbs' => [
			['title' => 'Fale conosco - Secretarias', 'url' => route('admin.sections.index')],
			['title' => 'Nova secretaria', 'url' => route('admin.sections.create')],
		]
	])

	@include('elements.admin.sections.form')
</div>
@stop