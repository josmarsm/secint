<?php
require_once "./funcoes/conexao.php";
require_once "./funcoes/crudInteressado.class.php";
$interessado = crudInteressado::getInstance(Conexao::getInstance());

$dados = $interessado->getAllInteressado();
$tabela = "";
foreach ($dados as $reg):
    $atendimento = '<center><a href=\"atendimentoInteressado.php?id=' . $reg->id_interessado . '\" onclick=\"atendimento()\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
    $editar = '<a href=\"editInteressado.php?a=' . $reg->id_interessado . '&b=' . $reg->nome . '&c=' . $reg->nome_curso . '&d=' . $reg->fone_residencial.'&d=' . $reg->fone_celular . '&e=' . $reg->email . '\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
    
    $tabela .= '{
				  "nome":"' . $reg->nome . '",
				  "nome_curso":"' . $reg->nome_curso . '",
				  "fone_residencial":"' . $reg->fone_residencial . '",
                                  "fone_celular":"' . $reg->fone_celular . '",
				  "email":"' . $reg->email. '",
                                  "atendimento":"' . $atendimento. '",    
				  "acoes":"' . $editar .'"
				},';

endforeach;

//eliminamos la coma que sobra
$tabela = substr($tabela, 0, strlen($tabela) - 1);

echo '{"aaData":[' . $tabela . ']}';
?>