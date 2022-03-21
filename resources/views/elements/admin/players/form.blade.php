@if (empty($player->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.players.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.players.update', $player->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($player, ['route' => ['admin.players.update', $player->id]]) !!}
  	{!!Form::hidden('id', $player->id)!!}
@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Título</b>
			{!!Form::text('title', old('title'), ['placeholder' => 'Título'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Descrição</b>
			{!!Form::text('description', old('description'), ['placeholder' => 'Descrição'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Texto do botão</b>
			{!!Form::text('button_text', old('button_text'), ['placeholder' => 'Texto do botão'])!!}
			<br/>
			<small>Ex.: Saiba mais</small>
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Link</b>
			<div class="link-field">
				{!!Form::text('link', old('link'), ['placeholder' => 'Link'])!!}
				<div class="ls-custom-select col-md-2">
					{!! Form::select('target', ['self' => 'Mesma página', 'blank' => 'Nova página'], old('target')) !!}
				</div>
			</div>
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Créditos da foto</b>
			{!!Form::text('copyright_name', old('copyright_name'), ['placeholder' => 'Créditos da foto'])!!}
		</label>
	</fieldset>
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Créditos da foto(link)</b>
			{!!Form::text('copyright_link', old('copyright_link'), ['placeholder' => 'Créditos da foto(link)'])!!}
		</label>
	</fieldset>
	@if (isset($player->desktop_file_name))
		@if ($player->desktop_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem desktop atual</b>
				<div class="span9 desktop">
					<img src="{!! $player->desktop->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Imagem desktop</b>
			{!!Form::file('desktop')!!}
			<br/>
			<small>Dimensões recomendadas: 1920x512</small>
		</label>
	</fieldset>
	@if (isset($player->mobile_file_name))
		@if ($player->mobile_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem mobile atual</b>
				<div class="span9 mobile">
					<img src="{!! $player->mobile->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
	<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Imagem mobile</b>
			{!!Form::file('mobile')!!}
			<br/>
			<small>Dimensões recomendadas: 1000x1072</small>
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
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.players.index')])
{!!Form::close()!!}