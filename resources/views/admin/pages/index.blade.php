@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Páginas',
      'class_icon' => 'ls-ico-bullhorn', 
      'breadcrumbs' => [
        ['title' => 'Páginas', 'url' => route('admin.pages.index')],
      ]
    ])

    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Título</b>
            {!!Form::text('filter_pages_title', Session::get('filter_pages_title'), ['placeholder' => 'Título', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Tipo</b>
            <div class="ls-custom-select">
              {!!Form::select('filter_pages_type', $types, Session::get('filter_pages_type'), ['placeholder' => 'Selecione um tipo de página'])!!}
            </div>
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.pages.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($pages) > 0)
      <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Título</th>
            <th>Tipo</th>
            <th></th>
            <th style="width: 95px;">Publicado</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="sortable-solution-list" class="ordered-list">
          @foreach($pages as $page)
            <tr id="featured_enterprises_{!! $page->id !!}">
              <td><a href="{!! route('admin.pages.edit', $page->id) !!}">{!!$page->title!!}</a></td>
              <td>{!! $types[$page->type] !!}</td>
              @if ($page->type == 'menu')
                <td><a class="ls-btn-primary" href="{{ route('admin.pages.subpages.index', $page->id) }}" aria-expanded="false">Subpáginas</a></td>
              @elseif ($page->type == 'link')
                <td><a href="{{ $page->link }}" target="_blank">{!! $page->link !!}</a></td>
              @elseif ($page->type == 'content')
                <td>
                  <a  id="link-{!! $page->id !!}" 
                      copyUrl="{!! url('/paginas/'.$page->slug) !!}" 
                      class="ls-btn-primary ls-ico-docs"
                      href="#"
                      aria-expanded="false"
                      onclick="copyToClipboard('link-{!! $page->id !!}')"
                      data-ls-popover="open" 
                      data-placement="top" 
                      data-ls-module="popover"
                      data-content="Link copiada para área de transferência"
                      title="Clique aqui para copiar o link da página para a área de transferência"></a>
                </td>
              @endif
              <td>{!! $page->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.pages.edit', $page->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.pages.destroy', $page->id)])</li>
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