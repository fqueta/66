@if (empty($user->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.users.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.users.update', $user->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($user, ['route' => ['admin.users.update', $user->id]]) !!}
  	{!!Form::hidden('id', $user->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Nome</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Nome'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Email</b>
			{!!Form::text('email', old('email'), ['placeholder' => 'Email'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Senha</b>
			{!!Form::password('password')!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Confirme sua senha</b>
			{!!Form::password('password_confirmation')!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Permissões</b>
		</label>
	</fieldset>
	<fieldset>
		@foreach($permissions as $permission)
			<label class="ls-label col-md-7">
				{!!Form::checkbox('permissions[]', $permission['name'], isset($selectedPermissions[$permission['name']]))!!} {!! $permission['displayName'] !!}
			</label>
		@endforeach
	</fieldset>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.users.index')])
{!!Form::close()!!}