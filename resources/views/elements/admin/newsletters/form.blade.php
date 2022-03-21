@if (empty($newsletter->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.newsletters.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.newsletters.update', $newsletter->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($newsletter, ['route' => ['admin.newsletters.update', $newsletter->id]]) !!}
  	{!!Form::hidden('id', $newsletter->id)!!}
@endif
	<div class="content-editor">
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
				<b class="ls-label-text">Categoria</b>
				<div class="ls-custom-select">
					{!!Form::select('bidding_category_id', $categories, old('bidding_category_id'), ['placeholder' => 'Selecione uma categoria'])!!}
				</div>
			</label>
		</fieldset>
	</div>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.newsletters.index')])
{!!Form::close()!!}