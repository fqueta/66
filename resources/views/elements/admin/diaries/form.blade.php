@if (empty($diary->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.diaries.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($diary, ['route' => ['admin.diaries.store']]) !!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.diaries.update', $diary->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($diary, ['route' => ['admin.diaries.update', $diary->id]]) !!}
  	{!!Form::hidden('id', $diary->id)!!}
@endif
	<div class="content-editor">
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Nº da edição</b>
				{!!Form::number('code', old('code'), ['placeholder' => 'Nº da edição'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Descrição</b>
				{!!Form::text('description', old('description'), ['placeholder' => 'Descrição', 'id' => 'diary_message'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-2">
				<b class="ls-label-text">Data</b>
				{!!Form::text('date', ($diary->date !== null && $diary->date->year > 0) ? $diary->date : '', ['placeholder' => 'dd/mm/aaaa', 'class' => "datepicker", "autocomplete" => "off"])!!}
			</label>
		</fieldset>
		@if (isset($diary->file_file_name) && $diary->file_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Arquivo atual</b>
				<div class="span9 desktop">
					<a href="{!! $diary->file->url() !!}">Clique aqui para baixar o arquivo atual</a>
				</div>
			</label>
		@endif
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Arquivo</b>
				{!!Form::file('file')!!}
			</label>
		</fieldset>
	</div>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.diaries.index')])
{!!Form::close()!!}