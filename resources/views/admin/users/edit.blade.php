@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Usuários | Editar usuário',
		'class_icon' => 'ls-ico-cog', 
		'breadcrumbs' => [
			['title' => 'Usuários', 'url' => route('admin.users.index')],
			['title' => 'Editar usuário', 'url' => route('admin.users.edit')],
		]
	])

	@include('elements.admin.users.form')
</div>
@stop