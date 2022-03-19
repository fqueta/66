@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Licitações - Recebimento de notificações',
      'class_icon' => 'ls-ico-chart-bar-up', 
      'breadcrumbs' => [
        ['title' => 'Licitações - Recebimento de notificações', 'url' => route('admin.newsletters.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Nome</b>
              {!!Form::text('filter_newsletters_name', Session::get('filter_newsletters_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
            </label>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Categoria</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_newsletters_category', $categories, Session::get('filter_newsletters_category'), ['placeholder' => 'Selecione uma categoria'])!!}
              </div>
            </label>
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.newsletters.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($newsletters) > 0)
      <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small>
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Categoria</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($newsletters as $newsletter)
            <tr>
              <td><a href="{!! route('admin.newsletters.edit', $newsletter->id) !!}">{!!$newsletter->name!!}</a></td>
              <td>{!!$newsletter->email!!}</td>
              <td>{!! ($newsletter->bidding_category_id) ? $categories[$newsletter->bidding_category_id] : $biddings[$newsletter->bidding_id] !!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.newsletters.edit', $newsletter->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.newsletters.destroy', $newsletter->id)])</li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $newsletters->appends(\Input::except('newsletter'))->render() !!}
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
          $.post("/admin/newsletters/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop