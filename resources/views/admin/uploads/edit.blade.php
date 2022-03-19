@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Uploads de arquivos | Editar arquivo',
		'class_icon' => 'ls-ico-list2', 
		'breadcrumbs' => [
			['title' => 'Uploads de arquivos', 'url' => route('admin.file_uploads.index')],
			['title' => 'Editar arquivo', 'url' => route('admin.file_uploads.edit')],
		]
	])

	@include('elements.admin.uploads.form')
</div>
@stop