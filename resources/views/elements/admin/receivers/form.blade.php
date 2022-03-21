@if (empty($receiver->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.receivers.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.receivers.update', $receiver->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($receiver, ['route' => ['admin.receivers.update', $receiver->id]]) !!}
  	{!!Form::hidden('id', $receiver->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Nome do destinatário</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Nome do destinatário'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Email do destinatário</b>
			{!!Form::text('email', old('email'), ['placeholder' => 'Email do destinatário'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Departamento</b>
			<div class="ls-custom-select">
				{!!Form::select('section_id', $sections, old('section'), ['placeholder' => 'Selecione um departamento'])!!}
			</div>
		</label>
	</fieldset>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.receivers.index')])
{!!Form::close()!!}