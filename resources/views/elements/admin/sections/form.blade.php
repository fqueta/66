@if (empty($section->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.sections.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.sections.update', $section->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($section, ['route' => ['admin.sections.update', $section->id]]) !!}
  	{!!Form::hidden('id', $section->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Nome do departamento</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Nome do departamento'])!!}
		</label>
	</fieldset>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.sections.index')])
{!!Form::close()!!}