@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Usuários | Novo usuário',
		'class_icon' => 'ls-ico-cog', 
		'breadcrumbs' => [
			['title' => 'Usuários', 'url' => route('admin.users.index')],
			['title' => 'Novo usuário', 'url' => route('admin.users.create')],
		]
	])

	@include('elements.admin.users.form')
</div>
@stop