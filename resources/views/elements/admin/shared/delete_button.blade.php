
{!!
	Form::open([
		'url' => $route,
		'method' => 'DELETE'
	])
!!}
{!! Form::close() !!}
<a class="ls-color-danger" href="#" role="option" onclick="if (confirm('Tem certeza que deseja deletar esse registro?')) { $(this).prev().submit(); }">Excluir</a>