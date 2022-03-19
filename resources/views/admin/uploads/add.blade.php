@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Gerenciador de arquivos | Novo upload',
		'class_icon' => 'ls-ico-list2', 
		'breadcrumbs' => [
			['title' => 'Gerenciador de arquivos', 'url' => route('admin.file_uploads.index')],
			['title' => 'Novo upload', 'url' => route('admin.file_uploads.create')],
		]
	])

	@include('elements.admin.uploads.form')
</div>
@stop