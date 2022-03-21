@if (empty($page->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.pages.subpages.store', $parent_page->id],
		'method' => 'POST',
		'class' => 'ls-form row'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.pages.subpages.update', $parent_page->id, $page->id],
		'method' => 'PUT',
		'class' => 'ls-form row'
	])!!}
	{!!Form::model($page, ['route' => ['admin.pages.subpages.update', $parent_page->id, $page->id]]) !!}
  {!!Form::hidden('id', $page->id)!!}
@endif
	<div class="product_container">
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Título</b>
				{!!Form::text('title', old('title'), ['placeholder' => 'Título'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Tipo</b>
				<div class="ls-custom-select">
					{!!Form::select('type', ['content' => 'Conteúdo', 'link' => 'Link'], old('type'), ['placeholder' => "Selecione um tipo de página", 'id' => 'select-page-type', 'class' => 'ls-select', 'autocomplete' => 'off'])!!}
				</div>
			</label>
		</fieldset>
		{!! Form::hidden('page_id', $parent_page->id) !!}
		@include('elements.admin.subpages.conteudo_input')
		@include('elements.admin.subpages.link_input')
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
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.pages.subpages.index', $parent_page->id)])
{!!Form::close()!!}
@include('elements.admin.shared.sir-trevor')