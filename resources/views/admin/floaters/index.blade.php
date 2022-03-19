@extends('layout.admin')
@section('content')
	<div class="container-fluid">
		@include('elements.admin.shared.header', [
			'title' => 'Floaters',
			'class_icon' => 'ls-ico-images', 
			'breadcrumbs' => [
				['title' => 'Floaters', 'url' => route('admin.floaters.index')],
			]
		])

			<div class="ls-box-filter">
				<form action="" class="ls-form ls-form-horizontal row">
					<fieldset>
						<label class="ls-label col-md-4 col-xs-12">
							<b class="ls-label-text">Nome</b>
							{!!Form::text('filter_floaters_name', Session::get('filter_floaters_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
						</label>
						<input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
					</fieldset>
				</form>
			</div>

		@include('elements.admin.shared.add_button', [
			'route' => route('admin.floaters.create'),
			'button_title' => 'Cadastrar novo'
			])

		@include('elements.admin.shared.results', ['count' => $count])

		@if (count($floaters) > 0)
			<small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
			<table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
				<thead>
					<tr>
						<th>Título</th>
						<th></th>
						<th></th>
						<th>Link</th>
						<th style="width: 95px;">Publicado</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="sortable-solution-list" class="ordered-list">
					@foreach($floaters as $floater)
						<tr id="featured_enterprises_{!! $floater->id !!}">
							<td><a href="{!! route('admin.floaters.edit', $floater->id) !!}">{!!$floater->name!!}</a></td>
							<td><img src="{!!$floater->mobile->url('thumbnail')!!}"></td>
							<td><img src="{!!$floater->desktop->url('thumbnail')!!}"></td>
							<td><a href="{!! $floater->link !!}">{!! $floater->link !!}</a></td>
							<td>{!! $floater->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
							<td class="ls-txt-right ls-regroup">
								<div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
									<a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
									<ul class="ls-dropdown-nav" aria-hidden="true">
										<li>@include('elements.admin.shared.edit_button', ['route' => route('admin.floaters.edit', $floater->id)])</li>
										<li>@include('elements.admin.shared.delete_button', ['route' => route('admin.floaters.destroy', $floater->id)])</li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
@stop
@section('scripts')
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$("#sortable-solution-list").sortable({
				update: function( event, ui ) {
					$.post("/admin/floaters/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
					})
				}
			});
		});
	</script>
@stop