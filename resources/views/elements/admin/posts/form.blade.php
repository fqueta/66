@if (empty($post->id))
	{!!Form::open([
		'files' => true,
		'route' => ['admin.posts.store'],
		'method' => 'POST',
		'class' => 'ls-form row',
		'id' => 'form-noticias'
	])!!}
@else
	{!!Form::open([
		'files' => true,
		'route' => ['admin.posts.update', $post->id],
		'method' => 'PUT',
		'class' => 'ls-form row',
		'id' => 'form-noticias'
	])!!}
	{!!Form::model($post, ['route' => ['admin.posts.update', $post->id]]) !!}
  {!!Form::hidden('id', $post->id, ['id' => 'post_id'])!!}
@endif
	<div class="content-editor">
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Título</b>
				{!!Form::text('title', old('title'), ['placeholder' => 'Título'])!!}
			</label>
		</fieldset>		
		<fieldset>
			<label class="ls-label col-md-2">
				<b class="ls-label-text">Data</b>
				{!!Form::text('date', ($post->date !== null && $post->date->year > 0) ? $post->date : '', ['placeholder' => 'dd/mm/aaaa', 'class' => "datepicker"])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Descrição</b>
				{!!Form::textarea('description', old('description'), ['placeholder' => 'Descrição', 'data-ls-module' => 'charCounter', 'maxlength' => '180'])!!}
			</label>
		</fieldset>
		<fieldset>
			<label class="ls-label col-md-12">
				<b class="ls-label-text">Conteúdo</b>
				<fieldset id="editor_content_container" style="display: none;">
						<section class="content">
							{!!Form::textarea('content', old('content'), ['placeholder' => 'Conteúdo', 'class' => 'js-st-instance'])!!}
						</section>
				</fieldset>
			</label>
		</fieldset>
		@if (isset($post->image_preview_file_name))
			@if ($post->image_preview_file_name != '')
				<label class="ls-label col-md-7">
					<b class="ls-label-text">Imagem atual</b>
					<div class="span9">
						<img src="{!! $post->image_preview->url('thumbnail_admin') !!}">
					</div>
				</label>
				@if( file_exists(public_path().$post->image_preview->url()) && getimagesize(public_path().$post->image_preview->url())[0] >= 1547 )
		      <label class="ls-label col-md-7">
		      	<b class="ls-label-text">Imagem de capa</b>
		        <div data-ls-module="switchButton" class="ls-switch-btn">
							{!! Form::hidden('cover_image', 0) !!}
							{!! Form::checkbox('cover_image', 1, old('active'), ["id" => 'cover_image_select'])!!}
							<label class="ls-switch-label" for="cover_image_select" name="label-teste"><span></span></label>
						</div>
		      </label>
					<label class="ls-label col-md-7 cover_image_canvas">
						<b class="ls-label-text">Imagem de capa atual</b>
						<div class="span9">
							<img class="my-image">
						</div>
					</label>
				@endif
			@endif
		@endif		
		<fieldset>
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem atual</b>
				{!!Form::file('image_preview', ['id' => 'image_input'])!!}
				<br/>
				<small>Dimensões recomendadas: 1920x512</small>
			</label>
		</fieldset>
		<fieldset>
      <label class="ls-label col-md-7">
      	<b class="ls-label-text">Publicado</b>
        <div data-ls-module="switchButton" class="ls-switch-btn">
					{!! Form::hidden('active', 0) !!}
					{!! Form::checkbox('active', 1, ($status == 'creating') ? true : old('active'), ["id" => 'teste'])!!}
					<label class="ls-switch-label" for="teste" name="label-teste"><span></span></label>
				</div>
      </label>
    </fieldset>
	</div>
	<hr>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.posts.index')])
{!!Form::close()!!}
@include('elements.admin.shared.sir-trevor', ['post' => $post])
@section('script')
	<script src="/admin_files/js/croppie.min.js"></script>
	<script>
		$('#cover_image_select').change((e) => {
			if(e.target.checked)
				$('.cover_image_canvas').show();
			else
				$('.cover_image_canvas').hide();
		})

		uploadCrop = $('.my-image').croppie({
			viewport: { width: 960, height: 350 },
			boundary: { width: 1000, height: 500 },
			showZoomer: true,
		});
		@if($post->dimensions)
			uploadCrop.croppie('bind', {
		    points: {!! $post->dimensions !!},
		    url: "{!! $post->image_preview->url() !!}",
		    zoom: "{!! $post->zoom !!}",
			}).then(res => console.log(res)).catch(err => console.log(err));
		@else
			uploadCrop.croppie('bind', {
		    url: "{!! $post->image_preview->url() !!}",
			}).then(res => {
				@if(!$post->cover_image)
					if(!$('#cover_image_select').checked)
						$('.cover_image_canvas').hide();
				@else
					console.log(res);
				@endif
			} ).catch(err => console.log(err));
		@endif

		$("#form-noticias").on('submit', function(e){			
			e.preventDefault();
			var that = this;
			$('.ls-btn').text('Enviando...');
			uploadCrop.croppie('result', {
				type: 'html',
				size: 'viewport',
			}).then(function (resp) {
				let dimensions = uploadCrop.croppie('get');
				$.ajax({
					url: "/api/posts/" + $("#post_id").val(),
					type: "PATCH",
					data: {
						"dimensions":JSON.stringify(dimensions.points),
						"zoom":dimensions.zoom,
					},
					success: function(response){
						console.log('a');
						$(that).unbind('submit').submit()
					}
				});
			});
		})
	</script>
@stop