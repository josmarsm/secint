<?php

include '../funcoes/config.php';
//require_once '../funcoes/funcoes.php';


if (isset($_REQUEST['funcao']) && isset($_REQUEST['funcao']) != "") {
    $funcao = $_REQUEST['funcao'] . '();';
    eval($funcao);
}

function GetCandidatoDelegar() {
    global $db;
    if (isset($_POST['id_candidato']) && isset($_POST['id_candidato']) != "") {
        $sql_identificacao = "SELECT identificacao.*, usuario.nome FROM identificacao INNER JOIN usuario ON usuario.id_usuario = identificacao.id_usuario WHERE identificacao.id_usuario=?";
        $sql_linha = "SELECT * FROM linha_pesquisa WHERE id_linha_pesquisa=?";
        $sql_orientador = "SELECT * FROM orientador INNER JOIN usuario on usuario.id_usuario = orientador.id_usuario WHERE id_orientador=?";
        $sql_documentos = "SELECT * FROM documento WHERE id_usuario=?";

        $result_candidato = $db->prepare($sql_identificacao);
        $parametro_candidato = '1';
        $result_candidato->bindValue(1, $parametro_candidato);
        $result_candidato->execute();
        $res_candidato = $result_candidato->fetchAll(PDO::FETCH_ASSOC);

        if (!$res_candidato) {
            echo 'error';
        }

        $response = array();

        if (count($res_candidato) > 0) {
            $response = $res_candidato;
        } else {
            $response['status'] = 200;
            $response['message'] = "Data not found!";
        }
// display JSON data
        echo json_encode($response);
    } else {
        $response['status'] = 200;
        $response['message'] = "Invalid Request!";
    }
}

function DelegarCandidato() {
    global $db;

    if (isset($_POST)) {
// get values
        $id_candidato = $_POST['id_candidato'];
        $new_avaliador = $_POST['new_avaliador'];
        session_start();
        $atual_avaliador = $_SESSION['id_usuario'];
        $motivo = $_POST['motivo'];
        $data_alteracao = date("Y-m-d H:i:s");


        $log = 'O avaliador ' . $atual_avaliador . ' delegou a avaliaçaõ do candidato ' . $id_candidato . ' para o novo avaliador ' . $new_avaliador . ' pelo seguinte motivo: ' . $motivo . ', em ' . date('d-m-Y H:i:s', strtotime($data_alteracao));
        $sql_log = 'insert into logs (log, data) values (:log,:data_alteracao)';

        $result_logs = $db->prepare($sql_log);

        $result_logs->bindParam(':log', $log);
        $result_logs->bindParam(':data_alteracao', $data_alteracao);
        $result_logs->execute();
        var_dump($result_logs);


        $sql_delegar = 'update identificacao set comissao_avaliador_old=:atual_avaliador, comissao_avaliador=:new_avaliador, data_alteracao=:data_alteracao where id_usuario=:id_candidato';
        var_dump($sql_delegar);
        $result_delegar = $db->prepare($sql_delegar);
        $result_delegar->bindParam(':atual_avaliador', $atual_avaliado);
        $result_delegar->bindParam(':new_avaliador', $new_avaliador);
        $result_delegar->bindParam(':data_alteracao', $data_alteracao);
        $result_delegar->bindParam(':id_candidato', $id_candidato);
        $result_delegar->execute();
        var_dump($result_delegar);
    }
}

function GetCandidatoAvaliar() {
    global $db;


    $sql_identificacao = "SELECT identificacao.*, usuario.nome FROM identificacao INNER JOIN usuario ON usuario.id_usuario = identificacao.id_usuario WHERE identificacao.id_usuario=?";
    $sql_linha = "SELECT * FROM linha_pesquisa WHERE id_linha_pesquisa=?";
    $sql_orientador = "SELECT * FROM orientador INNER JOIN usuario on usuario.id_usuario = orientador.id_usuario WHERE id_orientador=?";
    $sql_documentos = "SELECT * FROM documento WHERE id_usuario=?";

    if (isset($_POST['id_candidato']) && isset($_POST['id_candidato']) != "") {
        // get User ID
        $candidato_id = $_POST['id_candidato'];

        $result_identificacao = $db->prepare($sql_identificacao);
        $parametro_identificacao = $candidato_id;
        $result_identificacao->bindValue(1, $parametro_identificacao);
        $result_identificacao->execute();
        $identificacao = $result_identificacao->fetchAll(PDO::FETCH_ASSOC);

//print_r($identificacao);
//echo '</pre>';

        $candidato = array();
        foreach ($identificacao as $array_identificacao) {

            $result_candidato = $db->prepare($sql_identificacao);
            $parametro_candidato = $candidato_id;
            $result_candidato->bindValue(1, $parametro_candidato);
            $result_candidato->execute();
            $res_candidato = $result_candidato->fetchAll(PDO::FETCH_ASSOC);

            $result_linha1 = $db->prepare($sql_linha);
            $parametro_linha1 = $res_candidato[0]['linha_pesquisa_1'];
            $result_linha1->bindValue(1, $parametro_linha1);
            $result_linha1->execute();
            $res_linha1 = $result_linha1->fetchAll(PDO::FETCH_ASSOC);

            $result_linha2 = $db->prepare($sql_linha);
            $parametro_linha2 = $res_candidato[0]['linha_pesquisa_2'];
            $result_linha2->bindValue(1, $parametro_linha2);
            $result_linha2->execute();
            $res_linha2 = $result_linha2->fetchAll(PDO::FETCH_ASSOC);

            $result_orientador1 = $db->prepare($sql_orientador);
            $parametro_orientador1 = $res_candidato[0]['orientador_1'];
            $result_orientador1->bindValue(1, $parametro_orientador1);
            $result_orientador1->execute();
            $res_orientador1 = $result_orientador1->fetchAll(PDO::FETCH_ASSOC);

            $result_orientador2 = $db->prepare($sql_orientador);
            $parametro_orientador2 = $res_candidato[0]['orientador_2'];
            $result_orientador2->bindValue(1, $parametro_orientador2);
            $result_orientador2->execute();
            $res_orientador2 = $result_orientador2->fetchAll(PDO::FETCH_ASSOC);

            $result_orientador3 = $db->prepare($sql_orientador);
            $parametro_orientador3 = $res_candidato[0]['orientador_3'];
            $result_orientador3->bindValue(1, $parametro_orientador3);
            $result_orientador3->execute();
            $res_orientador3 = $result_orientador3->fetchAll(PDO::FETCH_ASSOC);

            $id_identificacao = $array_identificacao['id_identificacao'];
            $nome_candidato = $res_candidato[0]['nome'];
            $linha_pesquisa_1 = $res_linha1[0]['linha_pesquisa'];
            $linha_pesquisa_2 = $res_linha2[0]['linha_pesquisa'];
            $orientador_1 = $res_orientador1[0]['nome'];
            $orientador_2 = $res_orientador2[0]['nome'];
            $orientador_3 = $res_orientador3[0]['nome'];

            if ($res_candidato[0]['poscomp'] == "Sim") {
                $poscomp = $res_candidato[0]['poscomp'] . ' {' . $res_candidato[0]['ano_poscomp'] . ' - ' . $res_candidato[0]['nota_poscomp'] . '}';
            } else {
                $poscomp = $res_candidato[0]['poscomp'];
            }

            $bolsa = $res_candidato[0]['bolsa'];

            $result_documentos = $db->prepare($sql_documentos);
            $parametro_documento = '1';
            $result_documentos->bindValue(1, $parametro_documento);
            $result_documentos->execute();
            $documentos = $result_documentos->fetchAll(PDO::FETCH_ASSOC);


            $json_array = array(
                'id_identificacao' => $id_identificacao,
                'nome_candidato' => $nome_candidato,
                'linha_pesquisa_1' => $linha_pesquisa_1,
                'linha_pesquisa_2' => $linha_pesquisa_2,
                'orientador_1' => $orientador_1,
                'orientador_2' => $orientador_2,
                'orientador_3' => $orientador_3,
                'poscomp' => $poscomp,
                'bolsa' => $bolsa,
                $json_array['documentos'] = $documentos
            );


            array_push($candidato, $json_array);
        }
        echo json_encode($candidato, JSON_FORCE_OBJECT);
    }
}
