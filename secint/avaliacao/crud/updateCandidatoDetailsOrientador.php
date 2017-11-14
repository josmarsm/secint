<?php

// include Database connection file
include("config.php");

// check request
if (isset($_POST)) {

    $poscomp = Explode(" ", $_REQUEST['poscomp']);
    //echo $poscomp[0]; 


    $id_identificacao = $_REQUEST['id_identificacao'];

    switch ($poscomp[0]) {
        case 'Sim':
            $nota_entrevista = $_POST['nota_entrevista'];
            $query = "UPDATE candidato SET nota_entrevista = '$nota_entrevista' WHERE id_identificacao = '$id_identificacao'";
            break;
        default:
            $nota_prova = $_POST['nota_prova'];
            if (empty($_POST['nota_entrevista'])) {
                $nota_entrevista = 0;
            } else {
                $nota_entrevista = $_POST['nota_entrevista'];
            }
            $query = "UPDATE candidato SET nota_prova='$nota_prova', nota_entrevista='$nota_entrevista' WHERE id_identificacao = '$id_identificacao'";
            break;
    }
    
    $statement = $db->prepare($query);
    //var_dump($statement);
    $result = $statement->execute();

    if (!empty($result)) {
        echo 'Dados alterados com sucesso';
    }
}