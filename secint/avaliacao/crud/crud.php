<?php

session_start();
$perfil = $_SESSION['perfil'];
$avaliador = $_SESSION['id_usuario'];

$acao = $_REQUEST['acao'];
$id_candidato = $_REQUEST['id_candidato'];

include("config.php");
include("function.php");

global $db;

if ($perfil == 1) {
    $query_candidato_comissao = "SELECT * FROM candidato where id_candidato <> 0";
    $query_candidato_orientador = "SELECT * FROM candidato where id_candidato <> 0";
} else {
    $avaliador = $_SESSION['id_usuario'];
    $query_candidato_comissao .= "SELECT * FROM candidato where comissao_avaliador =$avaliador";
    $query_candidato_orientador .= "SELECT * FROM candidato where orientador_1 =$avaliador";
}

switch ($acao) {
    case "all_candidatos_comissao":
        $output_comissao = array();
        if (isset($_POST["search"]["value"])) {
            $query_candidato_comissao .= ' AND nome LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $query_candidato_comissao .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query_candidato_comissao .= ' ORDER BY nome ASC ';
        }
        if ($_POST["length"] != -1) {
            $query_candidato_comissao .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $statement = $db->prepare($query_candidato_comissao);
        $statement->execute();
        $result = $statement->fetchAll();

        $data = array();
        $filtered_rows = $statement->rowCount();
        $number = 1;
        foreach ($result as $row) {

            $sub_array = array();
            $id_candidato = $row["id_candidato"];
            $sub_array[] = $row["inscricao"];
            $sub_array[] = $row["nome"];

            if ($row["pagamento_inscricao"] == "Sim") {
                $inscricao = '<font style="color:green">' . $row["pagamento_inscricao"] . '</font>';
            } else {
                $inscricao = '<font style="color:red">' . $row["pagamento_inscricao"] . '</font>';
            }
            if ($row["documentacao"] == "Sim") {
                $documentacao = '<font style="color:green">' . $row["documentacao"] . '</font>';
            } else {
                $documentacao = '<font style="color:red">' . $row["documentacao"] . '</font>';
            }

            $sub_array[] = '<p style="text-align:center;">' . $inscricao . ' |' . $documentacao . '</p>';
            $sub_array[] = $row["nota_curriculo"];

            if ($row["status_fase1"] == 1) {
                $status = '<div class="text-center"><button type="button" name="reavaliar" class="btn btn-info btn-xs reavaliar" onclick="one_candidatos_comissao(' . $id_candidato . ')">Reavaliar</button></div>';
            } else {
                $status = '<div class="text-center"><button type="button" name="avaliar" class="btn btn-success btn-xs avaliar" onclick="one_candidatos_comissao(' . $id_candidato . ')">Avaliar</button></div>';
            }
            $sub_array[] = $status;

            if ($row["nota_curriculo"] >= 5) {
                $situacao_fase1 = '<p style="text-align:center; color:green;">Classificado</p>';
            } else {
                $situacao_fase1 = '<p style="text-align:center; color:red;">Não Classificado</p>';
            }
            $sub_array[] = $situacao_fase1;

            if ($row["status_fase1"] == 1) {
                $delegar = "";
            } else {
                $delegar = '<div class="text-center"><button type="button" name="delegar" id="' . $id_candidato . '" class="btn btn-warning btn-xs delegar">Delegar</button></div>';
            }
            $sub_array[] = $delegar;
            $sub_array[] = 'Curriculo';
            $data[] = $sub_array;
            $number++;
        }

        $output_comissao = array(
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => get_total_all_records_comissao($avaliador),
            "data" => $data
        );
        echo json_encode($output_comissao);
        break;

    case "all_candidatos_orientador":
        $output_orientador = array();
        if (isset($_POST["search"]["value"])) {
            $query_candidato_orientador .= ' AND nome LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $query_candidato_orientador .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query_candidato_orientador .= ' ORDER BY nome ASC ';
        }
        if ($_POST["length"] != -1) {
            $query_candidato_orientador .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
//var_dump($query_candidato_orientador);
        $statement = $db->prepare($query_candidato_orientador);
//        var_dump($statement);
        $statement->execute();
        $result = $statement->fetchAll();
//print_r($result);
        $data = array();
        $filtered_rows = $statement->rowCount();
//print_r($filtered_rows);
        $number = 1;
        foreach ($result as $row) {

            $sub_array = array();
            $id_candidato = $row["id_candidato"];
            //echo $id_candidato;
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
                        . "WHERE id_candidato = '$id_candidato'";
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
                    . "WHERE id_candidato = '$id_candidato'";
            $statement = $db->prepare($query);
            $result = $statement->execute();


            $sub_array[] = $row["nota_entrevista"];


            $sub_array[] = $row["nota_final"];

            if ($row["status_fase1"] == 1) {
                $status = '<button type="button" name="reaavaliar" class="btn btn-info btn-xs reavaliar" onclick="one_candidatos_orientador(' . $id_candidato . ')">Reavaliar</button>';
            } else {
                $status = '<button type="button" name="avaliar" class="btn btn-success btn-xs avaliar" onclick="one_candidatos_orientador(' . $id_candidato . ')">Avaliar</button>';
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
                $delegar = '<button type="button" name="avaliar" id="' . $id_candidato . '" class="btn btn-warning btn-xs delegar">Delegar</button>';
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
        break;

    case "one_candidato_comissao":
        $output = array();
        $statement = $db->prepare(
                'SELECT * FROM candidato 
		WHERE id_candidato = ' . $id_candidato . ''
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output["id_candidato"] = $row["id_candidato"];
            $output["nome_candidato"] = $row["nome"];
            $output["linha_pesquisa_1"] = $row["linha_pesquisa_1"];
            $output["linha_pesquisa_2"] = $row["linha_pesquisa_2"];
            $output["orientador_1"] = $row["orientador_1"];
            $output["orientador_2"] = $row["orientador_2"];
            $output["orientador_3"] = $row["orientador_3"];
            $output["poscomp"] = $row["poscomp"];
            $output["ano_poscomp"] = $row["ano_poscomp"];
            $output["nota_poscomp"] = $row["nota_poscomp"];
            $output["bolsa"] = $row["bolsa"];
            $output["nota_curriculo"] = $row["nota_curriculo"];
        }
        echo json_encode($output);
        break;

    case "one_candidato_orientador":
        $sql_linha = "select * from linha_pesquisa where id_linha_pesquisa=:linha";
        $sql_orientador = "select * from usuario where id_usuario=:orientador";
        $output = array();
        $statement = $db->prepare(
                'SELECT * FROM candidato 
		WHERE id_candidato = ' . $id_candidato . ''
        );
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $row) {
            $output["id_candidato"] = $row["id_candidato"];
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
        break;

    case "salva_candidato_comissao":
        $id_candidato = $_REQUEST['id_candidato'];
        $linha_pesquisa_1 = $_POST['linha_pesquisa_1'];
        $linha_pesquisa_2 = $_POST['linha_pesquisa_2'];
        $orientador_1 = $_POST['orientador_1'];
        $orientador_2 = $_POST['orientador_2'];
        $orientador_3 = $_POST['orientador_3'];
        $poscomp = $_POST['poscomp'];
        if (empty($_POST['ano_poscomp'])) {
            $ano_poscomp = 0;
        } else {
            $ano_poscomp = $_POST['ano_poscomp'];
        }
        if (empty($_POST['nota_poscomp'])) {
            $nota_poscomp = 0;
        } else {
            $nota_poscomp = $_POST['nota_poscomp'];
        }
        $bolsa = $_POST['bolsa'];
        $nota_curriculo = $_POST['nota_curriculo'];
        $query = "UPDATE candidato SET "
                . "linha_pesquisa_1 = '$linha_pesquisa_1', "
                . "linha_pesquisa_2 = '$linha_pesquisa_2', "
                . "orientador_1 = '$orientador_1', "
                . "orientador_2 = '$orientador_2', "
                . "orientador_3 = '$orientador_3', "
                . "poscomp = '$poscomp', "
                . "ano_poscomp = '$ano_poscomp',"
                . "nota_poscomp = '$nota_poscomp',"
                . "bolsa = '$bolsa',"
                . "status_fase1 = 1,"
                . "nota_curriculo='$nota_curriculo' "
                . "WHERE id_candidato = '$id_candidato'";
        $statement = $db->prepare($query);
        $result = $statement->execute();
        if (!empty($result)) {
            echo 'Dados alterados com sucesso';
        }
        break;

    case "salva_candidato_orientador":
        $poscomp = Explode(" ", $_REQUEST['poscomp']);
        
        switch ($poscomp[0]) {
            case 'Sim':
                $nota_entrevista = $_POST['nota_entrevista'];
                $query = "UPDATE candidato SET nota_entrevista = '.$nota_entrevista.' WHERE id_candidato = '.$id_candidato.'";
                break;
            default:
                $nota_prova = $_POST['nota_prova'];
                if (empty($_POST['nota_entrevista'])) {
                    $nota_entrevista = 0;
                } else {
                    $nota_entrevista = $_POST['nota_entrevista'];
                }
                $query = "UPDATE candidato SET nota_prova='$nota_prova', nota_entrevista='$nota_entrevista' WHERE id_candidato = '$id_candidato'";
                break;
        }
        $statement = $db->prepare($query);
        //var_dump($statement);
        $result = $statement->execute();

        if (!empty($result)) {
            echo 'Dados alterados com sucesso';
        }
        break;

    case "all_observacao":

        $query = "SELECT observacao.*,usuario.nome FROM observacao "
                . "INNER JOIN usuario ON usuario.id_usuario = observacao.id_avaliador"
                . " where id_candidato =" . $id_candidato;
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $rowCount = $statement->rowCount();
        //print_r($rowCount);

        if ($rowCount > 0) {
            echo '{"observacoes":' . json_encode($result) . '}';
        } else {
            echo '0';
        }
        break;
    case "salva_observacao":
        $observacao = $_REQUEST['observacao'];
        $query = "INSERT INTO observacao (id_candidato, id_avaliador, observacao, data_registro) VALUES(:id_candidato, :id_avaliador, :observacao, :data_registro)";
        if ($observacao == "") {
            echo 'O texto da observação não pode ficar em branco!';
        } else {
            try {
                $statement = $db->prepare($query);
                $statement->execute(array(
                    ':id_candidato' => $id_candidato,
                    ':id_avaliador' => $avaliador,
                    ':observacao' => $observacao,
                    ':data_registro' => '2017-11-04'
                ));
                //echo $statement->rowCount();
                echo 'Observação inserida com sucesso!';
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        break;
    case "default":
        break;
}   