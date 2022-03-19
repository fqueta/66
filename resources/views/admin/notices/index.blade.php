@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Comunicados',
      'class_icon' => 'ls-ico-bullhorn',
      'breadcrumbs' => [
        ['title' => 'Comunicados', 'url' => route('admin.notices.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Título</b>
              {!!Form::text('filter_notices_title', Session::get('filter_notices_title'), ['placeholder' => 'Título', 'class' => 'ls-field'])!!}
            </label>
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.notices.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($notices) > 0)
      <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Título</th>
            <th style="width: 105px;">Data</th>
            <th style="width: 155px;">Data de expiração</th>
            <th style="width: 95px;">Expirado</th>
            <th style="width: 95px;">Publicado</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="sortable-solution-list" class="ordered-list">
          @foreach($notices as $notice)
            <tr id="featured_enterprises_{!! $notice->id !!}" class="{!! ($notice->expiration_date->lt(Carbon\Carbon::now())) ? 'expired' : '' !!}">
              <td><a href="{!! route('admin.notices.edit', $notice->id) !!}">{!! $notice->title!!}</a></td>
              <td>{!! $notice->date->format('d/m/Y') !!}</td>
              <td>{!! $notice->expiration_date->format('d/m/Y') !!}</td>
              <td>{!! ($notice->expiration_date->lt(Carbon\Carbon::now())) ? '<p class="ls-tag-danger">Sim</p>' : '<p class="ls-tag-success">Não</p>' !!}</td>
              <td>{!! $notice->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.notices.edit', $notice->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.notices.destroy', $notice->id)])</li>
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
  <script src="/admin_files/js/markdown.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $("#sortable-solution-list").sortable({
        update: function( event, ui ) {
          $.notice("/admin/notices/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop
