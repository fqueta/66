@if (empty($notice->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.notices.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.notices.update', $notice->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($notice, ['route' => ['admin.notices.update', $notice->id]]) !!}
  	{!!Form::hidden('id', $notice->id)!!}
@endif
	<div class="content-editor">
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Título</b>
				{!!Form::text('title', old('title'), ['placeholder' => 'Título'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-2">
				<b class="ls-label-text">Data</b>
				{!!Form::text('date', ($notice->date !== null && $notice->date->year > 0) ? $notice->date : '', ['placeholder' => 'dd/mm/aaaa', 'class' => "datepicker"])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-2">
				<b class="ls-label-text">Data de expiração</b>
				{!!Form::text('expiration_date', ($notice->expiration_date !== null && $notice->expiration_date->year > 0) ? $notice->expiration_date : '', ['placeholder' => 'dd/mm/aaaa', 'class' => "datepicker"])!!}
			</label>
		</fieldset>

		<fieldset>
			<label class="ls-label col-md-12">
				<b class="ls-label-text">Conteúdo</b>
				{!!Form::text('content', old('content'), ['placeholder' => 'Conteúdo', 'id' => 'notice_message'])!!}
			</label>
		</fieldset>

		<fieldset>
      <label class="ls-label col-md-7">
      	<b class="ls-label-text">Publicado</b>
        <div data-ls-module="switchButton" class="ls-switch-btn">
					{!! Form::hidden('active', 0) !!}
					{!! Form::checkbox('active', 1, ($status == 'creating') ? true : old('active'), ["id" => 'teste'])!!}
					<label class="ls-switch-label" for="teste" name="label-teste"><span></span></label>
				</div>
      </label>
    </fieldset>
	</div>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.notices.index')])
{!!Form::close()!!}
@section('head')
	<link rel="stylesheet" href="/admin_files/css/simplemde.min.css">
@stop
@section('scripts')
	<script src="/admin_files/js/simplemde.min.js"></script>
	<script>
		var simplemde = new SimpleMDE({ element: $('#notice_message')[0], toolbar: ["bold", "italic", "|", 'link', "|", "preview"], spellChecker: false, });
	</script>
@stop