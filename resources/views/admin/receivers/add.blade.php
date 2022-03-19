@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Fale conosco - Recebimento de e-mails | Novo e-mail',
		'class_icon' => 'ls-ico-user', 
		'breadcrumbs' => [
			['title' => 'Fale conosco - Recebimento de e-mails', 'url' => route('admin.receivers.index')],
			['title' => 'Novo e-mail', 'url' => route('admin.receivers.create')],
		]
	])

	@include('elements.admin.receivers.form')
</div>
@stop