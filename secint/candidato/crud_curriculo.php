<?php

require_once '../funcoes/funcoes.php';




if (isset($_POST['criterio']) && isset($_POST['criterio']) != "") {
    $criterio = $_POST['criterio'];
    $response = array();
    $response['teste']=1;
    $response['nome']='josmar';
    $response['sobrenome']='nuernberg';
    echo json_encode($response);
    
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}


$id_usuario = isset($_REQUEST["id_usuario"]) ? addslashes(trim($_REQUEST["id_usuario"])) : FALSE;
$doc_subcriterio = isset($_POST["doc_subcriterio"]) ? addslashes(trim($_POST["doc_subcriterio"])) : FALSE;
$doc_nome = isset($_POST["doc_nome"]) ? addslashes(trim($_POST["doc_nome"])) : FALSE;
$doc_pontuacao = isset($_POST["doc_pontuacao"]) ? addslashes(trim($_POST["doc_pontuacao"])) : FALSE;
//$doc_criterio = isset($_REQUEST["doc_criterio"]) ? addslashes(trim($_REQUEST["doc_criterio"])) : FALSE;

date_default_timezone_set('America/Sao_Paulo');

$ext = strtolower(substr($_FILES['file']['name'], -4));
$nome_documento = $id_usuario . '-' . $doc_subcriterio . '-' . date("YmdHis") . $ext; //Definindo um novo nome para o arquivo
$dir_upload = 'upload/'; //Diretório para uploads
$doc_url = $dir_upload . $nome_documento;
$data_agora = date("Y-m-d H:i:s");

$vars = [
    $id_usuario,
    $doc_subcriterio,
    $doc_nome,
    $doc_pontuacao,
    $doc_url,
    $data_agora
];
print_r($vars);

$sql_upload = 'INSERT INTO documento (
        id_usuario,
        id_subcriterio,
        nome,
        pontuacao,
        url,
        data_alteracao)
            VALUES
            (?,?,?,?,?,?)';
$data_upload = set_data($sql_upload, $vars);
print_r($data_upload);

//echo $nome_documento . '<br>';
if (isset($_FILES['file']['name'])) {
    if (0 < $_FILES['file']['error']) {
        echo 'Error during file upload' . $_FILES['file']['error'];
    } else {
        //move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $nome_documento);

        //$data_upload = set_data($sql_upload, $vars);
        //print_r($data_upload);

        echo 'File successfully uploaded : upload/' . $nome_documento;
        echo '<br>';
        echo 'nome ' . $_POST['doc_nome'] . '<br>';
        echo 'subcriterio ' . $_POST['doc_subcriterio'] . '<br>';
        echo 'pontuacao ' . $_POST['doc_pontuacao'] . '<br>';
        echo 'criterio ' . $_POST['doc_criterio'] . '<br>';
    }
} else {
    echo 'Please choose a file';
}
    
