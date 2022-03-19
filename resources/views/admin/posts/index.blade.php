@extends('layout.admin')
@section('content')
  <div class="container-fluid">
    @include('elements.admin.shared.header', [
      'title' => 'Notícias',
      'class_icon' => 'ls-ico-bullhorn', 
      'breadcrumbs' => [
        ['title' => 'Notícias', 'url' => route('admin.posts.index')],
      ]
    ])

      <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-horizontal row">
          <fieldset>
            <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Título</b>
              {!!Form::text('filter_posts_title', Session::get('filter_posts_title'), ['placeholder' => 'Título', 'class' => 'ls-field'])!!}
            </label>
{{--             <label class="ls-label col-md-4 col-xs-12">
              <b class="ls-label-text">Categoria</b>
              <div class="ls-custom-select">
                {!!Form::select('filter_posts_category_id', $categories, Session::get('filter_posts_category_id'), ['placeholder' => 'Selecione uma categoria'])!!}
              </div>
            </label> --}}
            <input type="submit" class="ls-btn-primary" value="Filtrar" aria-expanded="false">
          </fieldset>
        </form>
      </div>

    @include('elements.admin.shared.add_button', [
      'route' => route('admin.posts.create'),
      'button_title' => 'Cadastrar novo'
      ])

    @include('elements.admin.shared.results', ['count' => $count])

    @if (count($posts) > 0)
      {{-- <small><b>Arraste os itens da listagem abaixo para alterar a ordenação</b></small> --}}
      <table class="ls-table ls-table-striped ls-no-hover ls-bg-header">
        <thead>
          <tr>
            <th>Título</th>
            <th style="width: 120px;">Data</th>
            {{-- <th>Categoria</th> --}}
            <th style="width: 95px;">Publicado</th>
            <th></th>
          </tr>
        </thead>
        {{-- <tbody id="sortable-solution-list" class="ordered-list"> --}}
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td><a href="{!! route('admin.posts.edit', $post->id) !!}">{!!$post->title!!}</a></td>
              <td>{!! $post->date->format('d/m/Y') !!}</td>
              <td>{!! $post->active ? '<p class="ls-tag-success">Sim</p>' : '<p class="ls-tag-danger">Não</p>' !!}</td>
              <td class="ls-txt-right ls-regroup">
                <div class="ls-dropdown ls-pos-right" data-ls-module="dropdown">
                  <a class="ls-btn ls-btn-sm" href="#" aria-expanded="false" role="combobox"></a>
                  <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li>@include('elements.admin.shared.edit_button', ['route' => route('admin.posts.edit', $post->id)])</li>
                    <li>@include('elements.admin.shared.delete_button', ['route' => route('admin.posts.destroy', $post->id)])</li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $posts->appends(\Input::except('post'))->render() !!}
    @endif
  </div>
@stop
{{-- @section('scripts')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $("#sortable-solution-list").sortable({
        update: function( event, ui ) {
          $.post("/admin/posts/order", $("#sortable-solution-list").sortable( "serialize"), function(data) {
          })
        }
      });
    });
  </script>
@stop --}}