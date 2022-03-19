@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => "Subpáginas de: $parent_page->title",
      'class_icon' => 'ls-ico-bullhorn',
      'breadcrumbs' => [
        ['title' => 'Páginas', 'url' => route('admin.pages.index')],
        ['title' => $parent_page->title, 'url' => route('admin.pages.edit', [$parent_page->id])],
        ['title' => 'Subpáginas', 'url' => route('admin.pages.subpages.index', $parent_page->id)],
      ]
    ])

    @include('elements.admin.shared.add_button', ['route' => route('admin.pages.subpages.create', $parent_page->id)])

    @include('elements.admin.shared.results', ['count' => count($pages)])

    @if (count($pages) > 0)
      <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Título</th>
              <th>Tipo</th>
              <th>Ativa</th>
              <th></th>
          </tr>
        </thead>
        <tbody id="sortable-solution-list" class="ordered-list">
        @foreach($pages as $page)
            <tr id="featured_enterprises_{!! $page->id !!}">
              <td><a href="{!! route('admin.pages.subpages.edit', [$parent_page->id, $page->id]) !!}">{!!$page->title!!}</a></td>
              <td>{!! $types[$page->type] !!}</td>
              <td>{!! $page->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>'!!}</td>
              <td class="ls-txt-right ls-regroup">
                  <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                    <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                    <ul class="ls-dropdown-nav" aria-hidden="true">
                      <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.pages.subpages.edit', [$parent_page->id, $page->id])])</li>
                      <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.pages.subpages.destroy', [$parent_page->id, $page->id])])</li>
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
          $.post("/admin/pages/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop