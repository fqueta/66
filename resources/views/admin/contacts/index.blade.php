@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Fale conosco - Mensagens recebidas',
      'class_icon' => 'ls-ico-user', 
      'breadcrumbs' => [
        ['title' => 'Fale conosco - Mensagens recebidas', 'url' => route('admin.contacts.index')],
      ]
    ])

    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('filter_contacts_name', Session::get('filter_contacts_name'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Email</b>
            {!!Form::text('filter_contacts_email', Session::get('filter_contacts_email'), ['placeholder' => 'Email', 'class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($contacts) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Mensagem</th>
              <th width="130">Recebido em</th>
              <th width="60"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
              <td>
                <p><strong>Nome: </strong>{!!$contact->name!!} </p>
                <p><strong>Email: </strong>{!!$contact->email!!}</p>
                <p><strong>Departamento: </strong>{!! (array_key_exists($contact->section_id, $sections->toArray())) ? $sections[$contact->section_id] : "" !!}</p>
                <p><strong>Mensagem: </strong>{!!$contact->message!!}</p>
              </td>
              
              <td>{!!$contact->created_at->format('d/m/Y')!!}</td>
              <td class="ls-txt-right ls-regroup">
                  <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                    <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                    <ul class="ls-dropdown-nav" aria-hidden="true">
                      <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.contacts.destroy', $contact->id)])</li>
                    </ul>
                  </div>
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
      {!! $contacts->appends(\Input::except('page'))->render() !!}
    @endif
  </div>
@stop