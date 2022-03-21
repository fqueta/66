@section('head')
	<link rel="stylesheet" type="text/css" href="/css/sir-trevor-custom.css">
	<link rel="stylesheet" type="text/css" href="/lib/css/sir-trevor.min.css">
	<link rel="stylesheet" type="text/css" href="/admin_files/css/sir-trevor-style.css">
	{{-- <link rel="stylesheet" type="text/css" href="//localhost:8080/sir-trevor.debug.css"> --}}
@stop
@section('scripts')
	<script type="text/javascript" src="/lib/js/sir-trevor.min.js"></script>
	{{-- <script type="text/javascript" src="//localhost:8080/sir-trevor.debug.js"></script> --}}
	<script type="text/javascript">
		SirTrevor.config.language = "pt";
		const editor = new SirTrevor.Editor({
			el: document.querySelector('.js-st-instance'),
			blockTypes: ["Text", "List", "Image", "Video", "Header1", "Header2", "Small", "Button", "Player"],
			iconUrl: '/lib/img/sir-trevor-icons.svg',
		  onEditorRender: function() {
				document.getElementById('editor_content_container').style.display = "block";
		  }
		});
	</script>
@stop