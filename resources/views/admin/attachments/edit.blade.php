@extends('layout.admin')
@section('content')
<div class="container-fluid">

	@include('elements.admin.shared.header', [
      'title' => "Anexos de: $parent_page->title",
      'class_icon' => 'ls-ico-chart-bar-up',
      'breadcrumbs' => [
        ['title' => 'Processos', 'url' => route('admin.biddings.index')],
        ['title' => $parent_page->title, 'url' => route('admin.biddings.edit', [$parent_page->id])],
        ['title' => 'Anexos', 'url' => route('admin.biddings.attachments.index', $parent_page->id)],
        ['title' => 'Editar subpágina', 'url' => route('admin.biddings.attachments.edit', [$parent_page->id, $page->id])],
      ]
    ])

	@include('elements.admin.attachments.form')
</div>
@stop