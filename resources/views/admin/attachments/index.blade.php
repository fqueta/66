@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => "Anexos de: $parent_page->title",
      'class_icon' => 'ls-ico-chart-bar-up',
      'breadcrumbs' => [
        ['title' => 'Licitações - Processos', 'url' => route('admin.biddings.index')],
        ['title' => $parent_page->title, 'url' => route('admin.biddings.edit', [$parent_page->id])],
        ['title' => 'Anexos', 'url' => route('admin.biddings.attachments.index', $parent_page->id)],
      ]
    ])

    <div class="ls-box-filter">
      {!!Form::open([
        'files' => true,
        'route' => ['admin.biddings.attachments.store', $parent_page->id],
        'method' => 'POST',
        'class' => 'ls-form ls-form-horizontal row'
      ])!!}
        {!!Form::hidden('bidding_id', $parent_page->id)!!}
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Título</b>
            {!!Form::text('title', Session::get('title'), ['placeholder' => 'Título', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-7">
            <b class="ls-label-text">Arquivo</b><br/>
            {!!Form::file('file', ['class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Cadastrar" aria-expanded="false">
        </fieldset>
      {!! Form::close() !!}
    </div>

    @include('elements.admin.shared.results', ['count' => count($attachments)])

    @if (count($attachments) > 0)
      <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Título</th>
              <th>Anexo</th>
              <th></th>
          </tr>
        </thead>
        <tbody id="sortable-solution-list" class="ordered-list">
        @foreach($attachments as $attachment)
            <tr id="featured_enterprises_{!! $attachment->id !!}">
              <td>{!!$attachment->title!!}</a></td>
              <td><a href="{!! $attachment->file->url() !!}" target="_blank">Clique aqui para baixar</a></td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.biddings.attachments.destroy', [$parent_page->id, $attachment->id])])</li>
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
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $("#sortable-solution-list").sortable({
        update: function( event, ui ) {
          $.post("/admin/biddings/{!! $parent_page->id !!}/attachments/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop