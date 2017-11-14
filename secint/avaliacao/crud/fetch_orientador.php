<?php

include("config.php");
global $db;
include("function.php");
session_start();

$perfil = $_SESSION['perfil'];
$query = '';

if ($perfil == 1) {
    $query .= "SELECT * FROM candidato where id_identificacao <> 0";
} else {
    $avaliador = $_SESSION['id_usuario'];
    $query .= "SELECT * FROM candidato where nota_curriculo >= 5 and orientador_1 =$avaliador";
}

//print_r($query);
$output_orientador = array();

if (isset($_POST["search"]["value"])) {
    $query .= ' AND nome LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= ' ORDER BY nome ASC ';
}
if ($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = $db->prepare($query);
//var_dump($statement);
$statement->execute();
$result = $statement->fetchAll();
//print_r($result);
$data = array();
$filtered_rows = $statement->rowCount();
//print_r($filtered_rows);
$number = 1;
foreach ($result as $row) {

    $sub_array = array();
    $id_identificacao = $row["id_identificacao"];
    $sub_array[] = $row["inscricao"];
    $sub_array[] = $row["nome"];
    $sub_array[] = $row["nota_curriculo"];

    if ($row["poscomp"] == 'Sim') {
        $sql_media_poscomp = "select * from media_poscomp where ano_poscomp=:parametro_poscomp";
        $parametro_poscomp = $row["ano_poscomp"];
        $statement_media_poscomp = $db->prepare($sql_media_poscomp);
        $statement_media_poscomp->bindParam(':parametro_poscomp', $parametro_poscomp);
        $statement_media_poscomp->execute();

        $media_poscomp = $statement_media_poscomp->fetchAll();
        $Nposcomp = $row["nota_poscomp"];
        $Mano = $media_poscomp[0]['media_poscomp'];

        $output["$media_poscomp"] = $media_poscomp[0]['media_poscomp'];

        $prova_calculada = (8.0 + (($Nposcomp - $Mano) * 0.3));

        switch ($prova_calculada) {
            case $prova_calculada < 0:
                $prova_calculada = 0;
                break;
            case $prova_calculada > 10:
                $prova_calculada = 10;
                break;
            default:
                $prova_calculada = $prova_calculada;
        }

        $query = "UPDATE candidato SET "
                . "nota_prova_convertida = '$prova_calculada' "
                . "WHERE id_identificacao = '$id_identificacao'";
        $statement = $db->prepare($query);
        $result = $statement->execute();


        $fase1 = $row["nota_curriculo"];
        $fase2 = (($row["nota_prova_convertida"] / 2) + ($row["nota_entrevista"] / 2));
        $sub_array[] = $prova_calculada . ' Poscomp';
    } else {
        $sub_array[] = $row["nota_prova"];
        $fase1 = $row["nota_curriculo"];
        $fase2 = (($row["nota_prova"] / 2) + ($row["nota_entrevista"] / 2));
    }

    $nota_final = (($fase1 * 0.4) + ($fase2 * 0.6));
    $query = "UPDATE candidato SET "
            . "nota_final = '$nota_final' "
            . "WHERE id_identificacao = '$id_identificacao'";
    $statement = $db->prepare($query);
    $result = $statement->execute();


    $sub_array[] = $row["nota_entrevista"];


    $sub_array[] = $row["nota_final"];
    
    if ($row["status_fase1"] == 1) {
        $status = '<button type="button" name="reaavaliar" class="btn btn-info btn-xs reavaliar" onclick="GetCandidatoDetailsOrientador(' . $id_identificacao . ')">Reavaliar</button>';
    } else {
        $status = '<button type="button" name="avaliar" class="btn btn-success btn-xs avaliar" onclick="GetCandidatoDetailsOrientador(' . $id_identificacao . ')">Avaliar</button>';
    }
    $sub_array[] = $status;

    if ($row["nota_final"] >= 7) {
        $situacao_fase1 = '<font color=green>Classificado</font>';
    } else {
        $situacao_fase1 = '<font color=red>Não Classificado</font>';
    }

    $sub_array[] = $situacao_fase1;

    if ($row["status_fase1"] == 1) {
        $delegar = "";
    } else {
        $delegar = '<button type="button" name="avaliar" id="' . $id_identificacao . '" class="btn btn-warning btn-xs delegar">Delegar</button>';
    }
    $sub_array[] = $delegar;

    $data[] = $sub_array;
    $number++;
}

$output_orientador = array(
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records_orientador($avaliador),
    "data" => $data
);

echo json_encode($output_orientador);
?>