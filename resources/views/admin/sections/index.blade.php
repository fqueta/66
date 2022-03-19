@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Fale conosco - Secretarias',
      'class_icon' => 'ls-ico-user', 
      'breadcrumbs' => [
        ['title' => 'Fale conosco - Secretarias', 'url' => route('admin.sections.index')],
      ]
    ])

    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('filter_sections_name', Session::get('filter_sections_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.sections.create'),
      'button_title' => 'Cadastrar novo'
    ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($sections) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Nome</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($sections as $section)
            <tr>
              <td><a href="{!! route('admin.sections.edit', $section->id) !!}">{!!$section->name!!}</a></td>
              <td class="ls-txt-right ls-regroup">
                  <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                    <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                    <ul class="ls-dropdown-nav" aria-hidden="true">
                      <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.sections.edit', $section->id)])</li>
                      <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.sections.destroy', $section->id)])</li>
                    </ul>
                  </div>
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
      {!! $sections->appends(\Input::except('page'))->render() !!}
    @endif
  </div>
@stop