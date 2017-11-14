<?php

include("config.php");
include("function.php");
session_start();
$avaliador = $_SESSION['id_usuario'];
//global $db;

$sql_linha = "select * from linha_pesquisa where id_linha_pesquisa=:linha";
$sql_orientador = "select * from usuario where id_usuario=:orientador";

if (isset($_POST["id_identificacao"])) {
    $output = array();
    $statement = $db->prepare(
            'SELECT * FROM candidato 
		WHERE id_identificacao = ' . $_POST["id_identificacao"] . ''
    );
//print_r($statement);
    $statement->execute();
    $result = $statement->fetchAll();
//print_r($result); 
    foreach ($result as $row) {
        $output["id_identificacao"] = $row["id_identificacao"];
        $output["nome_candidato"] = $row["nome"];

        $parametro_linha1 = $row["linha_pesquisa_1"];
        $statement_linha1 = $db->prepare($sql_linha);
        $statement_linha1->bindParam(':linha', $parametro_linha1);
        $statement_linha1->execute();
        $linha1 = $statement_linha1->fetchAll();
        $output["linha_pesquisa_1"] = $linha1[0]['linha_pesquisa'];

        $parametro_linha2 = $row["linha_pesquisa_2"];
        $statement_linha2 = $db->prepare($sql_linha);
        $statement_linha2->bindParam(':linha', $parametro_linha2);
        $statement_linha2->execute();
        $linha2 = $statement_linha2->fetchAll();
        $output["linha_pesquisa_2"] = $linha2[0]['linha_pesquisa'];

        $parametro_orientador1 = $row["orientador_1"];
        $statement_orientador1 = $db->prepare($sql_orientador);
        $statement_orientador1->bindParam(':orientador', $parametro_orientador1);
        $statement_orientador1->execute();
        $orientador1 = $statement_orientador1->fetchAll();
        $output["orientador_1"] = $orientador1[0]['nome'];

        $parametro_orientador2 = $row["orientador_2"];
        $statement_orientador2 = $db->prepare($sql_orientador);
        $statement_orientador2->bindParam(':orientador', $parametro_orientador2);
        $statement_orientador2->execute();
        $orientador2 = $statement_orientador2->fetchAll();
        $output["orientador_2"] = $orientador2[0]['nome'];

        $parametro_orientador3 = $row["orientador_3"];
        $statement_orientador3 = $db->prepare($sql_orientador);
        $statement_orientador3->bindParam(':orientador', $parametro_orientador3);
        $statement_orientador3->execute();
        $orientador3 = $statement_orientador3->fetchAll();
        $output["orientador_3"] = $orientador3[0]['nome'];

        $output["poscomp"] = $row["poscomp"];
        $output["ano_poscomp"] = $row["ano_poscomp"];
        $output["nota_poscomp"] = $row["nota_poscomp"];

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

            //Nescrita = 8,0 + (Nposcomp - Mano) x 0,3
            $prova_calculada = (8.0 + (($Nposcomp - $Mano) * 0.3));
            $output["nota_prova"] = $prova_calculada . ' - Conversao Poscomp';
            $output["prova_calculada"] = $prova_calculada;

            $fase1 = $row["nota_curriculo"];
            $fase2 = (($row["nota_prova_convertida"] / 2) + ($row["nota_entrevista"] / 2));
        } else {
            $output["nota_prova"] = $row["nota_prova"];
            $fase1 = $row["nota_curriculo"];
            $fase2 = (($row["nota_prova"] / 2) + ($row["nota_entrevista"] / 2));
        }

        $nota_final = (($fase1 * 0.4) + ($fase2 * 0.6));
        //print_r($fase1);
        
        $output["nota_final"] = $nota_final;
        $output["bolsa"] = $row["bolsa"];
        $output["nota_curriculo"] = $row["nota_curriculo"];
        $output["nota_entrevista"] = $row["nota_entrevista"];
    }
//print_r($output);
    echo json_encode($output);
}
?>