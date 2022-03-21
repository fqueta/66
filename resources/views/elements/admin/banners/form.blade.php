@if (empty($banner->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.banners.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.banners.update', $banner->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($banner, ['route' => ['admin.banners.update', $banner->id]]) !!}
		{!!Form::hidden('id', $banner->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Mensagem</b>
			{!!Form::text('text', old('text'), ['placeholder' => 'Mensagem', 'id' => 'banner_message'])!!}
		</label>
	</fieldset>
	@if (isset($banner->image_file_name))
		@if ($banner->image_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem atual</b>
				<div class="span9">
					<img src="{!! $banner->image->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Imagem</b>
			{!!Form::file('image')!!}
			<br/>
			<small>Dimensões recomendadas: 1920x255</small>
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
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.banners.index')])
{!!Form::close()!!}

@section('head')
	<link rel="stylesheet" href="/admin_files/css/simplemde.min.css">
@stop
@section('scripts')
	<script src="/admin_files/js/simplemde.min.js"></script>
	<script>
		var simplemde = new SimpleMDE({ element: $('#banner_message')[0], toolbar: ["bold", "italic", "|", "preview"], spellChecker: false, });
	</script>
@stop