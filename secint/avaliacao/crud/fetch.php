<?php

include("config.php");
include("function.php");
session_start();

$perfil = $_SESSION['perfil'];
$query = '';


if ($perfil == 1) {
    $query .= "SELECT * FROM candidato where id_identificacao <> 0 ";
} else {
    $avaliador = $_SESSION['id_usuario'];
    $query .= "SELECT * FROM candidato where comissao_avaliador =$avaliador";
}


$output = array();

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

    if ($row["status"] == 1) {
        $status = 'Avaliado - <button type="button" name="avaliar" class="btn btn-info btn-xs reavaliar" onclick="GetCandidatoDetails(' . $id_identificacao . ')">Reavaliar</button>';
    } else {
        $status = 'Não Avaliado - <button type="button" name="avaliar" class="btn btn-success btn-xs avaliar" onclick="GetCandidatoDetails(' . $id_identificacao . ')">Avaliar</button>';
    }
    $sub_array[] = $status;

    if ($row["nota_curriculo"] >= 5) {
        $situacao_fase1 = '<font color=green>Classificado</font>';
    } else {
        $situacao_fase1 = '<font color=red>Não Classificado</font>';
    }
    $sub_array[] = $situacao_fase1;

    if ($row["status"] == 1) {
        $delegar = "";
    } else {
        $delegar = '<button type="button" name="avaliar" id="' . $id_identificacao . '" class="btn btn-warning btn-xs delegar">Delegar</button>';
    }
    $sub_array[] = $delegar;

    $data[] = $sub_array;
    $number++;
}

$output = array(
    "id_identificacao" => $row["id_identificacao"],
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records($avaliador),
    "data" => $data
);

echo json_encode($output);
?>