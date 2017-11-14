<?php
session_start();
$perfil = $_SESSION['perfil'];
//echo 'perfil '.$perfil;
function upload_image() {
    if (isset($_FILES["user_image"])) {
        $extension = explode('.', $_FILES['user_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = './upload/' . $new_name;
        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
        return $new_name;
    }
}

function get_image_name($user_id) {
    include('config.php');
    $statement = $db->prepare("SELECT image FROM users WHERE id = '$user_id'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row["image"];
    }
}

function get_total_all_records_comissao($avaliador) {
    include('config.php');
    $perfil = $_SESSION['perfil'];
    if ($perfil == 1) {
        $sql_comissao = "SELECT * FROM candidato";
    } else {
        $sql_comissao = "SELECT * FROM candidato where comissao_avaliador='$avaliador'";
    }
    $statement = $db->prepare($sql_comissao);
    $statement->execute();
    $result = $statement->fetchAll();
    //print_r($result);
    return $statement->rowCount();
}

function get_total_all_records_orientador($avaliador) {
    include('config.php');
    $perfil = $_SESSION['perfil'];
    if ($perfil == 1) {
        $sql_avaliador = "SELECT * FROM candidato";
    } else {
        $sql_avaliador = "SELECT * FROM candidato where orientador_1='$avaliador'";
    }
    
    $statement = $db->prepare($sql_avaliador);
    $statement->execute();
    $result = $statement->fetchAll();
    //print_r($result);
    return $statement->rowCount();
}

?>