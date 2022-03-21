<div class="content-wrapper-content" <?php if ($page->type != 'content') { echo 'style="display: none"'; } ?>>
	@if (isset($page->floater_file_name))
		@if ($page->floater_file_name != '')
			<label class="ls-label col-md-7">
				<b class="ls-label-text">Imagem de topo da área atual</b>
				<div class="span9 logo">
					<img src="{!! $page->floater->url('thumbnail') !!}">
				</div>
			</label>
		@endif
	@endif
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
</div>