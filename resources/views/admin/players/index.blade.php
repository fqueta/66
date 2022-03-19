@extends('layout.admin')
@section('content')
	<div class="container-fluid">
		@include('elements.admin.shared.header', [
			'title' => 'Slider',
			'class_icon' => 'ls-ico-images', 
			'breadcrumbs' => [
				['title' => 'Slider', 'url' => route('admin.players.index')],
			]
		])

		@include('elements.admin.shared.add_button', [
			'route' => route('admin.players.create'),
			'button_title' => 'Cadastrar novo'
		])

		@include('elements.admin.shared.results', ['count' => $count])

		@if (count($players) > 0)
			<small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
			<table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th>@sortablelink ('title', 'Título')</th>
						<th>Descrição</th>
						<th>Link</th>
						<th style="width: 95px;">Publicado</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="sortable-solution-list" class="ordered-list">
					@foreach($players as $player)
						<tr id="featured_enterprises_{!! $player->id !!}">
							<td><img src="{!!$player->mobile->url('thumbnail')!!}"></td>
							<td><img src="{!!$player->desktop->url('thumbnail')!!}"></td>
							<td>{!!$player->title!!}</td>
							<td class="ls-txt-left">{{ $player->description }}</td>
							<td class="ls-txt-left"><a target="_blank" href="{{ $player->link }}">{{ $player->link }}</a></td>
							<td class="ls-txt-left">{!! ($player->active) ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
							<td class="ls-txt-right ls-regroup">
								<div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
									<a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
									<ul class="ls-dropdown-nav" aria-hidden="true">
										<li>@include('elements.admin.shared.edit_button', ['route' => route('admin.players.edit', $player->id)])</li>
										<li>@include('elements.admin.shared.delete_button', ['route' => route('admin.players.destroy', $player->id)])</li>
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
				update: function(event, ui) {
					$.post("/admin/players/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {})
				}
			});
		});
	</script>
@stop