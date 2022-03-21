@section('head')
	<link rel="stylesheet" href="/admin_files/css/croppie.css" />
@stop
@section('scripts')
	<script src="/admin_files/js/croppie.min.js"></script>
	<script>
		$('.my-image').croppie();
	</script>
@stop