@extends('layout.admin')
@section('content')
<div class="container-fluid">

	@include('elements.admin.shared.header', [
      'title' => "Inscrições de: $parent_page->title",
      'class_icon' => 'ls-ico-text',
      'breadcrumbs' => [
        ['title' => 'Processos', 'url' => route('admin.biddings.index')],
        ['title' => $parent_page->title, 'url' => route('admin.biddings.edit', $parent_page->id)],
        ['title' => 'Inscrições', 'url' => route('admin.biddings.notifications.index', $parent_page->id)],
        ['title' => 'Editar notificação', 'url' => route('admin.biddings.notifications.edit', ["biddings" => $parent_page->id, "notifications" => $notifications->id])],
      ]
    ])

	@include('elements.admin.notifications.form')
</div>
@stop