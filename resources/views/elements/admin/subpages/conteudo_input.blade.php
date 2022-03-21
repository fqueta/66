<div class="content-wrapper-content" <?php if ($page->type != 'content') { echo 'style="display: none"'; } ?>>
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