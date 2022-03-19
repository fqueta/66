@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Gerenciador de arquivos',
      'class_icon' => 'ls-ico-images', 
      'breadcrumbs' => [
        ['title' => 'Gerenciador de arquivos', 'url' => route('admin.file_uploads.index')],
      ]
    ])

    <div class="ls-box-filter">
      <form action="" class="ls-form ls-form-horizontal row">
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('filter_uploads_title', Session::get('filter_uploads_title'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
        </fieldset>
      </form>
    </div>

    <div class="ls-box-filter">
      <label class="ls-label">
          <b class="ls-label-text">Novo arquivo</b>
      </label>
      {!!Form::open([
        'files' => true,
        'route' => ['admin.file_uploads.store'],
        'method' => 'POST',
        'class' => 'ls-form ls-form-horizontal row'
      ])!!}
        <fieldset>
          <label class="ls-label col-md-4 col-xs-12">
            <b class="ls-label-text">Nome</b>
            {!!Form::text('title', Session::get('title'), ['placeholder' => 'Nome', 'class' => 'ls-field'])!!}
          </label>
          <label class="ls-label col-md-7">
            <b class="ls-label-text">Arquivo</b><br/>
            {!!Form::file('file', ['class' => 'ls-field'])!!}
          </label>
          <input type="submit" class="ls-btn-primary" value="Cadastrar" aria-expanded="false">
        </fieldset>
      {!! Form::close() !!}
    </div>

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($uploads) > 0)
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Nome</th>
            <th style="width: 90px;"></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($uploads as $upload)
            <tr>
              <td><a href="{!! route('admin.file_uploads.show', $upload->slug) !!}">{!!$upload->title!!}</a></td>
              <td>
                <a id="link-{!! $upload->id !!}" 
                  copyUrl="{!! url("/api/uploads/".$upload->slug) !!}" 
                  class="ls-btn-primary ls-ico-docs"
                  href="#"
                  aria-expanded="false"
                  onclick="copyToClipboard('link-{!! $upload->id !!}')"
                  data-ls-popover="open" 
                  data-placement="top" 
                  data-ls-module="popover"
                  data-content="Link copiada para área de transferência"
                  title="Clique aqui para copiar o link da página para a área de transferência">
                </a>
              </td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.file_uploads.destroy', $upload->id)])</li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $uploads->appends(\Input::except('upload'))->render() !!}
    @endif
  </div>
@stop