@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Diário oficial',
      'class_icon' => 'ls-ico-bullhorn',
      'breadcrumbs' => [
        ['title' => 'Diário oficial', 'url' => route('admin.diaries.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Descrição</b>
              {!!Form::text('filter_diaries_description', Session::get('filter_diaries_description'), ['placeholder' => 'Descrição', 'class' => 'ls-field'])!!}
            </label>
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.diaries.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($diaries) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Nº da edição</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Arquivo</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="sortable-solution-list" class="ordered-list">
          @foreach($diaries as $diary)
            <tr id="featured_enterprises_{!! $diary->id !!}">
              <td>{!! $diary->code!!}</td>
              <td>{!! $diary->description!!}</td>
              <td>{!! $diary->date->format('d/m/Y') !!}</td>
              <td><a href="{!! $diary->file->url() !!}">Clique aqui para baixar o arquivo atual</a></td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.diaries.edit', $diary->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.diaries.destroy', $diary->id)])</li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $diaries->appends(\Input::except('diary'))->render() !!}
    @endif
  </div>
@stop
