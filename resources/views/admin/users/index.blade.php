@extends('layout.admin')
@section('content')
<div class="container-fluid">
  @include('elements.admin.shared.header', [
    'title' => 'Usuários',
    'class_icon' => 'ls-ico-cog', 
    'breadcrumbs' => [
    ['title' => 'Usuários', 'url' => route('admin.users.index')],
    ]
    ])


    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('filter_users_name', Session::get('filter_users_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Email</b>
            {!!Form::text('filter_users_email', Session::get('filter_users_email'), ['placeholder' => 'Email', 'class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

  @include('elements.admin.shared.add_button', [
    'route' => route('admin.users.create'),
    'button_title' => 'Cadastrar novo'
    ])

@include('elements.admin.shared.results', ['count' => $count])

@if (count($users) > 0)
<table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
  <thead>
    <tr>
      <th>@sortablelink ('name', 'Nome')</th>
      <th class="ls-txt-left">@sortablelink ('email', 'Email')</th>
      <th></th>
  </tr>
</thead>
<tbody>
    @foreach($users as $user)
    <tr>
      <td><a href="{!! route('admin.users.edit', $user->id) !!}">{!!$user->name!!}</a></td>
      <td class="ls-txt-left">{{ $user->email }}</td>
      <td class="ls-txt-right ls-regroup">
        <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
          <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
          <ul class="ls-dropdown-nav" aria-hidden="true">
            <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.users.edit', $user->id)])</li>
            <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.users.destroy', $user->id)])</li>
        </ul>
    </div>
</td>
</tr>
@endforeach
</tbody>
</table>
{!! $users->appends(\Input::except('page'))->render() !!}
@endif
</div>
@stop