<div class="content-wrapper-link" <?php if ($page->type != 'link') { echo 'style="display: none"'; } ?>>
<fieldset>
		<label class="ls-label col-md-7">
			<b class="ls-label-text">Link</b>
			<div class="link-field">
				{!! Form::text('link', old('link'), ['placeholder' => 'Link']) !!}
				<div class="ls-custom-select col-md-2">
					{!! Form::select('target', ['self' => 'Mesma página', 'blank' => 'Nova página'], old('target')) !!}
				</div>
			</div>
		</label>
	</fieldset>
</div>