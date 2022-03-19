@extends('layout.admin')
@section('content')
	<div class="container-fluid">
		@include('elements.admin.shared.header', [
			'title' => 'Banners',
			'class_icon' => 'ls-ico-images', 
			'breadcrumbs' => [
				['title' => 'Banners', 'url' => route('admin.banners.index')],
			]
		])

		@include('elements.admin.shared.add_button', [
			'route' => route('admin.banners.create'),
			'button_title' => 'Cadastrar novo'
			])

		@include('elements.admin.shared.results', ['count' => $count])

		@if (count($banners) > 0)
			<small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
			<table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
				<thead>
					<tr>
						<th>Texto</th>
						<th>Imagem</th>
						<th style="width: 95px;">Publicado</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="sortable-solution-list" class="ordered-list banner-list">
					@foreach($banners as $banner)
						<tr>
							<td>{!! $parse->text($banner->text) !!}</td>
							<td><img src="{!!$banner->image->url('thumbnail')!!}"></td>
							<td>{!! $banner->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
							<td class="ls-txt-right ls-regroup">
								<div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
									<a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
									<ul class="ls-dropdown-nav" aria-hidden="true">
										<li>@include('elements.admin.shared.edit_button', ['route' => route('admin.banners.edit', $banner->id)])</li>
										<li>@include('elements.admin.shared.delete_button', ['route' => route('admin.banners.destroy', $banner->id)])</li>
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
					$.post("/admin/banners/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
					})
				}
			});
		});
	</script>
@stop