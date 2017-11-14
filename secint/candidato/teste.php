<?php

require_once '../funcoes/funcoes.php';

//$sql_criterio = "SELECT * FROM criterio WHERE id_criterio =?";
$sql_subcriterio = "SELECT * FROM subcriterio WHERE id_criterio =?";
$sql_documento = "SELECT *
FROM `documento`
INNER JOIN subcriterio on documento.id_subcriterio = subcriterio.id_subcriterio
INNER JOIN criterio on subcriterio.id_criterio = criterio.id_criterio
where id_usuario = ? and criterio.id_criterio=?";

define('sql_documento', $sql_documento);


if (isset($_REQUEST['funcao']) && isset($_REQUEST['funcao']) != "") {
    $funcao = $_REQUEST['funcao'] . '();';
    eval($funcao);
}

function GetCriterio() {
    $criterio = $_REQUEST['criterio'];

    $sql_subcriterio = "SELECT * FROM subcriterio WHERE id_criterio =?";
    $var_subcriterio = [$criterio];
    $subcriterio = get_data($sql_subcriterio, $var_subcriterio);

    $data = '<select name="doc_subcriterio" id="doc_subcriterio" class="form-control">';
    $data .= '<option value = "">Selecione um Criterio</option>';

    foreach ($subcriterio as $col) {
        $data .= '<option value =' . $col['id_subcriterio'] . '>' . utf8_encode($col['subcriterio']) . '</option>';
    }
    $data .= '</select>';
    echo $data;
}

function AddDocumento() {
    //echo 'pegou a função AddDocumento<br>';
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
    //print_r($vars);

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
    //print_r($data_upload);
//echo $nome_documento . '<br>';
    if (isset($_FILES['file']['name'])) {
        if (0 < $_FILES['file']['error']) {
            echo 'Error during file upload' . $_FILES['file']['error'];
        } else {
            //move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $nome_documento);

            //$data_upload = set_data($sql_upload, $vars);
            //print_r($data_upload);
            $msg = '<div class="alert alert-success alert-dismissable fade in">';
            $msg .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            $msg .= '<strong>Success!</strong> Os dados foram salvos com sucesso.</div>';

            //echo 'File successfully uploaded : upload/' . $nome_documento;
            //echo '<br>';
            //echo 'nome ' . $_POST['doc_nome'] . '<br>';
            //echo 'subcriterio ' . $_POST['doc_subcriterio'] . '<br>';
            //echo 'pontuacao ' . $_POST['doc_pontuacao'] . '<br>';
            //echo 'criterio ' . $_POST['doc_criterio'] . '<br>';
            //GetDocumentos();
            echo $msg;
            //$total_pontuacao = 'precisa calcular';
            //echo $total_pontuacao;
        }
    } else {
        echo 'Please choose a file';
    }
}

function GetDocumentos() {
    echo 'pegou a função GetDocumentos<br>';
    $criterio = $_REQUEST['criterio'];
    $data = 'inicio dos dados do data';
    $data .= 'criterio selecionado para getdocumento ' . $criterio;
    $data .= ' fim dos dados do data';
    echo $data;
}

function Atualiza_Documentos() {
    //echo $_SESSION['id_usuario'];
    $id_usuario = $_REQUEST['id_usuario'];
    $criterio = $_REQUEST['criterio'];
    $var_documento = [$id_usuario, $criterio];
    $documento = get_data(sql_documento, $var_documento);
    $data = '<table id="tabela_uploads_'.$criterio.'" class="table table-striped table-bordered">
    

                                                        <thead>
                                                            <tr>         
                                                                <th class="hidden-xs">#</th>
                                                                <th class="col-text">Nome</th>
                                                                <th class="col-text">Subcritério</th>
                                                                <th class="col-text">Pontuação</th>
                                                                <th class="text-center">
                                                                    <span class="glyphicon glyphicon-wrench"></span>
                                                                </th>
                                                            </tr>
                                                        </thead>';
    $data .= '<tbody>';
    $order = 1;
    foreach ($documento as $row) {

        $data .= '<tr>                                                                
            <td class="hidden-xs">' . $order++ . '</td>';
        $data .= '<td>' . $row["nome"] . '</td>';
        $data .= '<td>' . $row["id_criterio"] . '</td>';
        $data .= '<td>' . $row["pontuacao"] . '</td>';
        $data .= '<td align="center">
                <a class="btn btn-default">
                    <span class="glyphicon glyphicon-pencil"
                          aria-hidden="true"></span>
                </a>
                <a class="btn btn-danger"
                   onclick="DeleteDocumento(' . $row["id_documento"] . ')">
                    <span class="glyphicon glyphicon-trash"
                          aria-hidden="true"></span>
                </a>
            </td>
        </tr>';
    }
    $data .= '</tbody>';
    $data .= '</table>';
    echo $data;
    //$total_pontuacao = 'precisa calcular';
    //echo $total_pontuacao;
}

function Deleta_Documento() {
    echo 'Acessou a função deeta documento';

    $id_documento = $_REQUEST['id_documento'];
    echo 'Este é o id do documento :' . $id_documento;
    $sql_documento_delete = 'DELETE FROM documento WHERE id_documento=?';
    $var_documento_delete = [$id_documento];

    $documento = get_data($sql_documento_delete, $var_documento_delete);

    print_r($documento);

    //$total_pontuacao = 'precisa calcular';
    //echo $total_pontuacao;
}
