@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => "Notificações de: $parent_page->title",
      'class_icon' => 'ls-ico-text',
      'breadcrumbs' => [
        ['title' => 'Processos', 'url' => route('admin.biddings.index')],
        ['title' => $parent_page->title, 'url' => route('admin.biddings.edit', [$parent_page->id])],
        ['title' => 'Notificações', 'url' => route('admin.biddings.notifications.index', $parent_page->id)],
      ]
    ])

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.biddings.notifications.create', $parent_page->id),
      'button_title' => 'Cadastrar novo'
    ])

    @include('elements.admin.shared.results', ['count' => count($notifications)])

    @if (count($notifications) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Título</th>
              <th>Mensagem</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
              <td>{!!$notification->title!!}</td>
              <td>{!!$notification->message!!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.biddings.notifications.destroy', ['biddings' => $parent_page->id, 'notifications' => $notification->id])])</li>
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