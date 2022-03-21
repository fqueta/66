@section('scripts')
	<script type="text/javascript" src="/admin_files/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		$(document).on( 'click', '#mce-modal-block', function() {
	        tinyMCE.activeEditor.windowManager.close();
	    });

	    tinymce.init({
	     language: "pt_BR",
	     relative_urls: false,
	     menubar: false,
	        selector: ".tinymce",
	        height: 500,
	        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
	        plugins: [
	          "advlist autolink lists link image charmap preview",
	          "searchreplace visualblocks code fullscreen",
	          "media table contextmenu paste",
	          "textcolor colorpicker"
	      ],
	      toolbar: "insertfile undo redo | fontsizeselect forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview | code",
	      external_filemanager_path:"/filemanager/",
	        filemanager_title:"Responsive Filemanager" ,
	        external_plugins: { "filemanager" : "/admin_files/filemanager/plugin.min.js"},
	        plugin_preview_width : "360",
	     plugin_preview_height : "564"
	    });
	</script>
@stop