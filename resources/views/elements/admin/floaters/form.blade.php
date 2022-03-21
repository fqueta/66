@if (empty($floater->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.floaters.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.floaters.update', $floater->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($floater, ['route' => ['admin.floaters.update', $floater->id]]) !!}
		{!!Form::hidden('id', $floater->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Título</b>
			{!!Form::text('name', old('name'), ['placeholder' => 'Título'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Link</b>
			{!!Form::text('link', old('link'), ['placeholder' => 'Link'])!!}
		</label>
	</fieldset>
	@if (isset($floater->desktop_file_name))
		@if ($floater->desktop_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem desktop atual</b>
				<div class="span9 desktop">
					<img src="{!! $floater->desktop->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Imagem desktop</b>
			{!!Form::file('desktop')!!}
		</label>
	</fieldset>

	@if (isset($floater->mobile_file_name))
		@if ($floater->mobile_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem mobile atual</b>
				<div class="span9 mobile">
					<img src="{!! $floater->mobile->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Imagem mobile</b>
			{!!Form::file('mobile')!!}
		</label>
	</fieldset>
{{-- 	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Travar a tela</b>
			<div data-ls-module="switchButton" class="ls-switch-btn">
				{!! Form::hidden('locked', 0) !!}
				{!! Form::checkbox('locked', 1, old('locked'), ["id" => 'teste'])!!}
				<label class="ls-switch-label" for="teste" name="label-teste"><span></span></label>
			</div>
		</label>
	</fieldset> --}}
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
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.floaters.index')])
{!!Form::close()!!}