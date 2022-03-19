@extends('layout.admin')
@section('content')
<div class="container-fluid">

	@include('elements.admin.shared.header', [
      'title' => "Subpáginas de: $parent_page->title",
      'class_icon' => 'ls-ico-bullhorn',
      'breadcrumbs' => [
        ['title' => 'Páginas', 'url' => route('admin.pages.index')],
        ['title' => $parent_page->title, 'url' => route('admin.pages.edit', [$parent_page->id])],
        ['title' => 'Subpáginas', 'url' => route('admin.pages.subpages.index', $parent_page->id)],
        ['title' => 'Editar subpágina', 'url' => route('admin.pages.subpages.edit', [$parent_page->id, $page->id])],
      ]
    ])

	@include('elements.admin.subpages.form')
</div>
@stop