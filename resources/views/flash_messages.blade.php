@if(Session::has('flash_sucess'))
	<div class="ls-alert-success ls-dismissable">
		<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
		{!! trans('messages.'.Session::get('flash_sucess')) !!}
	</div>
@endif
@if(Session::has('flash_warning'))
	<div class="ls-alert-warning ls-dismissable">
		<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
		{!! trans('messages.'.Session::get('flash_warning')) !!}
	</div>
@endif
@if(Session::has('flash_info'))
	<div class="ls-alert-info ls-dismissable">
		<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
		{!! trans('messages.'.Session::get('flash_info')) !!}
	</div>
@endif
@if(Session::has('flash_danger'))
	<div class="ls-alert-danger ls-dismissable">
		<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
		{!! trans('messages.'.Session::get('flash_danger')) !!}
	</div>
@endif