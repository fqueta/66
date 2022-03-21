@if (empty($notifications->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.biddings.notifications.store', $parent_page->id],
		'method' => 'POST',
		'class' => 'ls-form row',
		'data-ls-module' => 'form'
	])!!}
	{!!Form::hidden('bidding_id', $parent_page->id)!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.biddings.notifications.update', $parent_page->id, $notifications->id],
		'method' => 'PUT',
		'class' => 'ls-form row',
		'data-ls-module' => 'form'
	])!!}
		{!!Form::model($notifications, ['route' => ['admin.biddings.notifications.update', $notifications->id]]) !!}
  	{!!Form::hidden('bidding_id', $parent_page->id)!!}
  	{!!Form::hidden('id', $notifications->id)!!}

@endif
	<div class="content-editor">
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Título</b>
				{!!Form::text('title', old('title'), ['placeholder' => 'Título'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Mensagem</b>
				{!!Form::textarea('message', old('message'), ['rows' => '1', 'placeholder' => 'Mensagem', 'class' => 'ls-textarea-autoresize'])!!}
			</label>
		</fieldset>
	</div>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.biddings.notifications.index', $parent_page->id)])
{!!Form::close()!!}