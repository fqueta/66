@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Fale conosco - Recebimento de e-mails | Editar e-mail',
		'class_icon' => 'ls-ico-user', 
		'breadcrumbs' => [
			['title' => 'Fale conosco - Recebimento de e-mails', 'url' => route('admin.receivers.index')],
			['title' => 'Editar e-mail', 'url' => route('admin.receivers.edit')],
		]
	])

	@include('elements.admin.receivers.form')
</div>
@stop