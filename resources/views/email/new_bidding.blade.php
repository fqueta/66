<h1>{!! $bidding->title !!}</h1>
<p><strong>Processo: </strong>{!! $bidding->indentifier !!}</p>
<p><strong>Abertura: </strong>{!! $bidding->opening !!}</p>
<p>{!! $bidding->object !!}</p>

<a href="https://po.mg.gov.br/licitacoes/{!! $bidding->id !!}#view">
	Clique aqui para maiores informações
</a>