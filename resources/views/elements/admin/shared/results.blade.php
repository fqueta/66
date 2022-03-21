<div class="ls-alert-info" style="margin-top: 30px;">
@if ($count > 0)
	<p>
	@if ($count == 1)
		{{ 'Foi encontrado 1 resultado' }}
	@else
		{{ "Foram encontrados $count resultados" }} 
	@endif
	</p>
@else
	<p>Nenhum resultado foi encontrado</p>
@endif
</div>