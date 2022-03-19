<?php 
function getSocialMessage($type)
{
	$data = ["case" => "Eu Recomendo Algar Telecom sempre junto da minha empresa - Nilton Mayrink",
    		"cloud" => "Servidor Cloud de alto desempenho, escalabilidade, segurança e o melhor custo benefício do mercado.",
    		"videoconferencia" => "Servidor videoconferencia de alto desempenho",
    		"colocation" => "Colocation Placeholder",
    		"hosting" => "Hosting Placeholder",
    		"voztotal" => "voz total Placeholder",
    		"internetlink" => "internetlink Placeholder"];

    return $data[$type];
}
?>