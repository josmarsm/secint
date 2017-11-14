<?php
//$server = $_SERVER['SERVER_NAME'];
//$url = "http://" . $server . "/selecao/";
//echo $url;

//include "http://" . $server."/selecao/funcoes/config.php";
include '../../funcoes/config.php';
global $db;

//$sql = "SELECT * FROM usuario";
$parametro_documentos=1;
$sql_documentos = 'select * from documento where id_usuario=:parametro_documentos';
$result_documentos = $db->prepare($sql_identificacao);
$result_documentos->bindParam(':parametro_identificacao', $parametro_documentos);
$result_documentos->execute();
$count = $result_documentos->rowCount();
$rows = $result_documentos->fetchAll();
 
if ($count > 0) {
    $acao = 'view_documentos';
} else {
    $acao = 'add_identificacao';
}
echo $acao;
//$acao = '';
switch ($acao) {
    case 'add_identificacao' :
        echo 'Formulário de adição de identificação';        
        break;
    case 'edit_identificacao':
        echo 'Formulário de edição de identificação';
        print_r($rows);
        break;
    default:
        echo 'Formulário de visualização identificacao';
        print_r($rows);
        break;
}