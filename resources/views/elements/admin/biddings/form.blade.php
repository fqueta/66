@if (empty($bidding->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.biddings.store'],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.biddings.update', $bidding->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($bidding, ['route' => ['admin.biddings.update', $bidding->id]]) !!}
		{!!Form::hidden('id', $bidding->id)!!}
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
				<b class="ls-label-text">Categoria</b>
				<div class="ls-custom-select">
					{!!Form::select('bidding_category_id', $categories, old('bidding_category_id'), ['placeholder' => 'Selecione uma categoria'])!!}
				</div>
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Fase</b>
				<div class="ls-custom-select">
					{!!Form::select('phase_id', $phases, old('phase_id'), ['placeholder' => 'Selecione uma fase'])!!}
				</div>
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Modalidade</b>
				<div class="ls-custom-select">
					{!!Form::select('genre_id', $genres, old('genre_id'), ['placeholder' => 'Selecione uma modalidade'])!!}
				</div>
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Tipo</b>
				<div class="ls-custom-select">
					{!!Form::select('type_id', $types, old('type_id'), ['placeholder' => 'Selecione um tipo'])!!}
				</div>
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Processo</b>
				{!!Form::text('indentifier', old('indentifier'), ['placeholder' => 'Processo'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-2">
				<b class="ls-label-text">Data de abertura</b>
				{!!Form::text('opening', old('opening'), ['placeholder' => 'Data de abertura', 'id' => "datepicker-input"])!!}
				<small>Exemplo: 20/03/2018 12:30</small>
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Objeto</b>
				{!!Form::textarea('object', old('object'), ['placeholder' => 'Objeto'])!!}
			</label>
		</fieldset>
		@if($status !== 'creating')
			<fieldset>
				<label class="ls-label col-md-7">
					<b class="ls-label-text">Enviar notificação</b>
					<div data-ls-module="switchButton" class="ls-switch-btn">
						{!! Form::hidden('notification_check', 0) !!}
						{!! Form::checkbox('notification_check', 1, false)!!}
						<label class="ls-switch-label" for="teste" name="label-teste"><span></span></label>
					</div>
					<br/>
					<small>Todas as pessoas cadastradas para a área selecionada receberão um aviso sobre o novo processo</small>
				</label>
			</fieldset>
		@endif
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
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.biddings.index')])
{!!Form::close()!!}
@section('scripts')
	<script type="text/javascript">
		$(function() {
			$('#datepicker-input').mask('00/00/0000 00:00')
		})
	</script>
@stop