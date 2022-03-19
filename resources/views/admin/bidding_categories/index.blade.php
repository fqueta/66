@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Licitações - Áreas',
      'class_icon' => 'ls-ico-chart-bar-up', 
      'breadcrumbs' => [
        ['title' => 'Licitações - Áreas', 'url' => route('admin.bidding_categories.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Nome</b>
              {!!Form::text('filter_bidding_categories_name', Session::get('filter_bidding_categories_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
            </label>
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.bidding_categories.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($bidding_categories) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Título</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($bidding_categories as $bidding_category)
            <tr>
              <td><a href="{!! route('admin.bidding_categories.edit', $bidding_category->id) !!}">{!!$bidding_category->name!!}</a></td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.bidding_categories.edit', $bidding_category->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.bidding_categories.destroy', $bidding_category->id)])</li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $bidding_categories->appends(\Input::except('bidding_category'))->render() !!}
    @endif
  </div>
@stop