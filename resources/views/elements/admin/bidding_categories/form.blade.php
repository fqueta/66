@if (empty($bidding_category->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.bidding_categories.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.bidding_categories.update', $bidding_category->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($bidding_category, ['route' => ['admin.bidding_categories.update', $bidding_category->id]]) !!}
  	{!!Form::hidden('id', $bidding_category->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Nome</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Nome'])!!}
		</label>
	</fieldset>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.bidding_categories.index')])
{!!Form::close()!!}