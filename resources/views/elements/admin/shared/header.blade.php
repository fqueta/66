@if (isset($breadcrumbs))
	{!! Breadcrumbs::render('category', $breadcrumbs) !!}
@endif

<h1 class="ls-title-intro {{ $class_icon }}">{{ $title }}</h1>

@include('elements.shared.flash_messages')
@include('elements.shared.flash_error')