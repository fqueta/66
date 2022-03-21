@if (empty($category->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.categories.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.categories.update', $category->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}
  	{!!Form::hidden('id', $category->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Nome</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Nome'])!!}
		</label>
	</fieldset>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.categories.index')])
{!!Form::close()!!}