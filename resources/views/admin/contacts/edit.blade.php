@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Fale conosco - Mensagens recebidas | '. $contact->name,
		'class_icon' => 'ls-ico-user', 
		'breadcrumbs' => [
			['title' => 'Fale conosco - Mensagens recebidas', 'url' => route('admin.contacts.index')],
			['title' => $contact->name, 'url' => route('admin.contacts.edit')],
		]
	])

	<fieldset>
		<label class="ls-label col-md-9">
			<b class="ls-label-text">Nome</b>
			{!! $contact->name !!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-9">
			<b class="ls-label-text">Email</b>
			{!! $contact->email !!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-9">
			<b class="ls-label-text">Telefone</b>
			{!! $contact->phone !!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-9">
			<b class="ls-label-text">Cidade</b>
			{!! $contact->city !!} / {!! $contact->state !!}
		</label>
	</fieldset>
	@if($contact->subject)
		<fieldset>
			<label class="ls-label col-md-9">
				<b class="ls-label-text">Assunto</b>
				{!! $subjects[$contact->subject] !!}
			</label>
		</fieldset>
	@endif
	@if($contact->message)
		<fieldset>
			<label class="ls-label col-md-9">
				<b class="ls-label-text">Mensagem</b>
				{!! $contact->message !!}
			</label>
		</fieldset>
	@endif
	<fieldset>
		<label class="ls-label col-md-9">
			@include('elements.admin.contacts.form')
		</label>
	</fieldset>
</div>
@stop