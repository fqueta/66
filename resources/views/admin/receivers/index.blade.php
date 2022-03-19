@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Fale conosco - Recebimento de e-mails',
      'class_icon' => 'ls-ico-user', 
      'breadcrumbs' => [
        ['title' => 'Fale conosco - Recebimento de e-mails', 'url' => route('admin.receivers.index')],
      ]
    ])

    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('filter_receivers_name', Session::get('filter_receivers_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Email</b>
            {!!Form::text('filter_receivers_email', Session::get('filter_receivers_email'), ['placeholder' => 'Email', 'class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.receivers.create'),
      'button_title' => 'Cadastrar novo'
    ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($receivers) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>@sortablelink ('name', 'Nome')</th>
              <th>@sortablelink ('email', 'Email')</th>
              <th>Categoria</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($receivers as $receiver)
            <tr>
              <td><a href="{!! route('admin.receivers.edit', $receiver->id) !!}">{!! $receiver->name !!}</a></td>
              <td>{!!$receiver->email!!}</td>
              <td>{!! (array_key_exists($receiver->section_id, $sections->toArray())) ? $sections[$receiver->section_id] : "" !!}</td>
              <td class="ls-txt-right ls-regroup">
                  <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                    <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                    <ul class="ls-dropdown-nav" aria-hidden="true">
                      <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.receivers.edit', $receiver->id)])</li>
                      <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.receivers.destroy', $receiver->id)])</li>
                    </ul>
                  </div>
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
      {!! $receivers->appends(\Input::except('page'))->render() !!}
    @endif
  </div>
@stop