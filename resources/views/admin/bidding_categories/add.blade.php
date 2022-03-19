@extends('layout.admin')
@section('content')
<div class="container-fluid">
	@include('elements.admin.shared.header', [
		'title' => 'Licitações - Áreas | Nova área',
		'class_icon' => 'ls-ico-chart-bar-up', 
		'breadcrumbs' => [
			['title' => 'Licitações - Áreas', 'url' => route('admin.bidding_categories.index')],
			['title' => 'Nova área', 'url' => route('admin.bidding_categories.create')],
		]
	])

	@include('elements.admin.bidding_categories.form')
</div>
@stop