@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => "Inscrições de: $parent_page->title",
      'class_icon' => 'ls-ico-text',
      'breadcrumbs' => [
        ['title' => 'Processos', 'url' => route('admin.biddings.index')],
        ['title' => $parent_page->title, 'url' => route('admin.biddings.edit', [$parent_page->id])],
        ['title' => 'Inscrições', 'url' => route('admin.biddings.newsletters.index', $parent_page->id)],
      ]
    ])
    @include('elements.admin.shared.results', ['count' => count($newsletters)])

    @if (count($newsletters) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($newsletters as $newsletter)
            <tr>
              <td>{!!$newsletter->name!!}</td>
              <td>{!!$newsletter->email!!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.biddings.newsletters.destroy', ['biddings' => $parent_page->id, 'newsletters' => $newsletter->id])])</li>
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