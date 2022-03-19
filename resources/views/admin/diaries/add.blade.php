@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Diário oficial | Novo diário oficial',
		'class_icon' => 'ls-ico-bullhorn',
		'breadcrumbs' => [
			['title' => 'Diário oficial', 'url' => route('admin.diaries.index')],
			['title' => 'Novo diário oficial', 'url' => route('admin.diaries.create')],
		]
	])

	@include('elements.admin.diaries.form')
</div>
@stop
