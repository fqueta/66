@if (count($errors) > 0)
  <div class="ls-alert-danger ls-dismissable">
	<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
  </div>
@endif