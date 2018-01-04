<?php
require_once "./funcoes/conexao.php";
require_once "./funcoes/crudCliente.class.php";
$cliente = crudCliente::getInstance(Conexao::getInstance());

$dados = $cliente->getAllCliente();
$tabela = "";
foreach ($dados as $reg):
    $editar = '<a href=\"editCliente.php?a=' . $reg->id_cliente . '&b=' . $reg->nome . '&c=' . $reg->curso . '&d=' . $reg->telefone . '&e=' . $reg->email . '\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
    $eliminar = '<a href=\"deleteCliente.php?id=' . $reg->id_cliente . '\" onclick=\"return confirm(\'¿Seguro que desea eliminiar este usuario?\')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';

    $tabela .= '{
				  "id_cliente":"' . $reg->id_cliente . '",
				  "nome":"' . $reg->nome . '",
				  "curso":"' . $reg->curso . '",
				  "telefone":"' . $reg->telefone . '",
				  "email":"' . $reg->email. '",
				  "acoes":"' . $editar . $eliminar . '"
				},';

endforeach;

//eliminamos la coma que sobra
$tabela = substr($tabela, 0, strlen($tabela) - 1);

echo '{"data":[' . $tabela . ']}';
?>