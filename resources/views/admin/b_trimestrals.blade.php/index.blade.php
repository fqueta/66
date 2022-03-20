@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Licitações - Processos Trimestrais',
      'class_icon' => 'ls-ico-chart-bar-up', 
      'breadcrumbs' => [
        ['title' => 'Licitações - Processos Trimestrais', 'url' => route('admin.biddings.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Título</b>
              {!!Form::text('filter_biddings_title', Session::get('filter_biddings_title'), ['placeholder' => 'Título', 'class' => 'ls-field'])!!}
            </label>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Categoria</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_biddings_category', $categories, Session::get('filter_biddings_category'), ['placeholder' => 'Selecione uma categoria'])!!}
              </div>
            </label>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Fase</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_biddings_phase', $phases, Session::get('filter_biddings_phase'), ['placeholder' => 'Selecione uma fase'])!!}
              </div>
            </label>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Modalidade</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_biddings_genre', $genres, Session::get('filter_biddings_genre'), ['placeholder' => 'Selecione uma modalidade'])!!}
              </div>
            </label>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Tipos</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_biddings_type', $types, Session::get('filter_biddings_type'), ['placeholder' => 'Selecione um tipo'])!!}
              </div>
            </label>
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.biddings.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($biddings) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Título</th>
            <th style="width: 95px;">Publicado</th>
            <th>Categoria</th>
            <th>Fase</th>
            <th>Modalidade</th>
            <th>Tipos</th>
            <th>Inscrições</th>
            <th style="width: 50px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($biddings as $bidding)
            <tr id="featured_enterprises_{!! $bidding->id !!}">
              <td><a href="{!! route('admin.biddings.edit', $bidding->id) !!}">{!!$bidding->title!!}</a></td>
              <td>{!! $bidding->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
              <td>{!! $categories[$bidding->bidding_category_id] !!}</td>
              <td>{!! $phases[$bidding->phase_id] !!}</td>
              <td>{!! $genres[$bidding->genre_id] !!}</td>
              <td>{!! ($types[$bidding->type_id]) ? $types[$bidding->type_id] : "" !!}</td>
              {!! ($bidding->newsletters->count()) ? "<td class='newsletters-count'><span>".$bidding->newsletters->count()."</span></td>" : "<td></td>" !!}
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    @if(in_array($bidding->id, $biddings_with_resgistry))
                      <li><a href="{{ route('admin.biddings.notifications.index', $bidding->id) }}">Notificações</a></li>
                    @endif
                    @if($bidding->newsletters->count())
                      <li><a href="{{ route('admin.biddings.newsletters.index', $bidding->id) }}">Inscrições</a></li>
                    @endif
                    <li><a href="{{ route('admin.biddings.attachments.index', $bidding->id) }}">Anexos</a></li>
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.biddings.edit', $bidding->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.biddings.destroy', $bidding->id)])</li>
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
          $.post("/admin/biddings/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop