<?php

require_once "./conexao.php";
global $db;

if (isset($_REQUEST['funcao']) && isset($_REQUEST['funcao']) != "") {
    $funcao = $_REQUEST['funcao'] . '();';
//echo $funcao;
    eval($funcao);
}

function AllAtendimento() {
    global $db;
    $status = $_REQUEST['status'];

    if ($status == 'Finalizado') {
        $status = 1;
    } else {
        $status = 0;
    }//echo $status;
    try {
        $sql = "SELECT 
                a.id_atendimento, 
                a.assunto,
                i.nome_curso,
                a.data_registro, 
                i.nome as nome_interessado, 
                u.nome as nome_atendente,
                a.prioridade
                FROM atendimento a
                INNER JOIN interessado i ON a.id_interessado = i.id_interessado
                INNER JOIN usuario u on a.id_usuario = u.id_usuario
                WHERE a.status = $status
                order by a.data_registro DESC   ";
        $stm = $db->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erro) {
        echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
    }
    $tabela = "";
    foreach ($dados as $reg):
        $assunto = $reg->assunto;
//$atendimento = '<center><a href=\"atendimentoInteressado.php?id=' . $reg->id_atendimento . '\" onclick=\"viewAtendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
//$atendimento ='<a href="#" onclick="logout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
        switch ($reg->prioridade) {
            case 'Emergência':
                $atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento Prioritário\" class=\"btn btn-danger\"><i class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></i></a></center>';
                break;
            case 'Alta':
                $atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento Prioritário\" class=\"btn btn-warning\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
                break;            
            default:
                $atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-info\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
                break;
        }


        //$atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento Prioritário\" class=\"btn btn-danger\"><i class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></i></a> <a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';



        $tabela .= '{
				  "nome_curso":"' . $reg->nome_curso . '",
                                  "nome_interessado":"' . $reg->nome_interessado . '",
                                  "assunto":"' . $reg->assunto . '",
				  "nome_atendente":"' . $reg->nome_atendente . '",                                  
                                  "atendimento":"' . $atendimento . '"
				},';

    endforeach;

//eliminamos la coma que sobra
    $tabela = substr($tabela, 0, strlen($tabela) - 1);

    echo '{"aaData":[' . $tabela . ']}';
}

function AllAtendimentoPrioridade() {
    global $db;
    try {
        $sql_allprioridade = "SELECT 
                a.id_atendimento, 
                i.nome as nome_interessado,
                a.assunto,
                a.prioridade
                FROM atendimento a
                INNER JOIN interessado i ON a.id_interessado = i.id_interessado                
                WHERE a.status = 0 and a.prioridade IN ('Alta','Emergência')
                order by a.prioridade DESC, a.data_registro DESC";
        $stm_allprioridade = $db->prepare($sql_allprioridade);
        $stm_allprioridade->execute();
        $dados_allprioridade = $stm_allprioridade->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erro) {
        echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
    }
    $tabela = "";
    foreach ($dados_allprioridade as $reg):
        $assunto = $reg->assunto;
//$atendimento = '<center><a href=\"atendimentoInteressado.php?id=' . $reg->id_atendimento . '\" onclick=\"viewAtendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
//$atendimento ='<a href="#" onclick="logout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
        $atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
        $tabela .= '{
                                  "id_atendimento":"' . $reg->id_atendimento . '",				  
                                  "nome_interessado":"' . $reg->nome_interessado . '",
                                  "assunto":"' . $reg->assunto . '",
                                  "prioridade":"' . $reg->prioridade . '",
                                  "atendimento":"' . $atendimento . '"
				},';

    endforeach;

//eliminamos la coma que sobra
    $tabela = substr($tabela, 0, strlen($tabela) - 1);

    echo '{"aaData":[' . $tabela . ']}';
}

function contaAtendimentoPrioridade() {
    global $db;
    try {
        $sql = "SELECT *
                FROM atendimento a                
                WHERE a.status = 0 and a.prioridade IN ('Alta','Emergência')";
        $statement = $db->prepare($sql);
        $statement->execute();
        $total_prioridade = $statement->rowCount();
    } catch (PDOException $erro) {
        echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
    }
    echo json_encode(array("status" => TRUE, "total_prioridade" => $total_prioridade));
}

function buscaInteressado() {
    global $db;
    $term = "%" . $_GET['term'] . "%";
    $sql = "SELECT * FROM interessado WHERE nome LIKE :nome and status <> 0 ORDER BY nome ASC";
    $stm = $db->prepare($sql);
    $stm->bindValue(':nome', $term, PDO::PARAM_STR);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    $json = json_encode($dados);
    echo $json;
}

function buscaAssunto() {
    global $db;
    $term = "%" . $_GET['term'] . "%";
    $sql = "SELECT assunto FROM atendimento WHERE assunto LIKE :assunto GROUP BY assunto ORDER BY assunto ASC";
    $stm = $db->prepare($sql);
    $stm->bindValue(':assunto', $term, PDO::PARAM_STR);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    $json = json_encode($dados);
    echo $json;
}

function buscaCurso() {
    global $db;
    $term = "%" . $_GET['term'] . "%";
    $sql = "SELECT nome_curso FROM interessado WHERE nome_curso LIKE :nome_curso GROUP BY nome_curso ORDER BY nome_curso ASC";
    $stm = $db->prepare($sql);
    $stm->bindValue(':nome_curso', $term, PDO::PARAM_STR);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    $json = json_encode($dados);
    echo $json;
}

function buscaCategoria() {
    global $db;
    $term = "%" . $_GET['term'] . "%";
    $sql = "SELECT categoria FROM interessado WHERE categoria LIKE :categoria GROUP BY categoria ORDER BY categoria ASC";
    $stm = $db->prepare($sql);
    $stm->bindValue(':categoria', $term, PDO::PARAM_STR);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    $json = json_encode($dados);
    echo $json;
}

function save_atendimento() {
    session_start();
    global $db;
    $id_interessado = $_REQUEST['id_interessado'];
    $id_usuario = $_SESSION['usuarioID'];
    $assunto = $_REQUEST['assunto'];
    $data_registro = date("Y-m-d H:i:s");
    $matricula = $_REQUEST['matricula'];

    if ($assunto == "") {
        echo json_encode(array("status" => FALSE, "mensagem" => 'Favor informar o assunto'));
    } else {
        $sql = "INSERT INTO atendimento (id_interessado, id_usuario, assunto, data_registro) VALUES (?, ?, ?, ?)";
        $stm = $db->prepare($sql);
        $stm->bindValue(1, $id_interessado);
        $stm->bindValue(2, $id_usuario);
        $stm->bindValue(3, $assunto);
        $stm->bindValue(4, $data_registro);
        $stm->execute();

        $id_atendimento = $db->lastInsertId();

        $sql_matricula = 'SELECT * FROM interessado WHERE matricula=' . $matricula;
        $stm_matricula = $db->prepare($sql_matricula);
        $stm_matricula->execute();
        $matriculaCount = $stm_matricula->rowCount();

        if ($matriculaCount > 1) {

            $sql_status_1 = 'UPDATE interessado SET status =1 WHERE id_interessado=' . $id_interessado;
            $stm_status_1 = $db->prepare($sql_status_1);
            $stm_status_1->execute();

            $sql_status_0 = 'UPDATE interessado SET status = 0 WHERE id_interessado<>' . $id_interessado . ' and matricula=' . $matricula;
            $stm_status_0 = $db->prepare($sql_status_0);
            $stm_status_0->execute();
        } else {
            $sql_status_1 = 'UPDATE interessado SET status =1 WHERE id_interessado=' . $id_interessado;
            $stm_status_1 = $db->prepare($sql_status_1);
            $stm_status_1->execute();
        }
        $query = "INSERT INTO procedimento (id_atendimento, id_usuario, procedimento, data_registro) VALUES(:id_atendimento, :id_usuario, :procedimento, :data_registro)";
        $statement = $db->prepare($query);
        $statement->execute(array(
            ':id_atendimento' => $id_atendimento,
            ':id_usuario' => $id_usuario,
            ':procedimento' => 'Criou atendimento',
            ':data_registro' => date("Y-m-d H:i:s")
        ));
        echo json_encode(array("status" => TRUE, "mensagem" => 'Atendimento inserido com sucesso', 'id_atendimento' => $id_atendimento));
    }
}

function save_procedimento() {
    session_start();
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
    $id_usuario = $_SESSION['usuarioID'];
    $procedimento = $_REQUEST['procedimento'];
//echo $id_atendimento;
    $query = "INSERT INTO procedimento (id_atendimento, id_usuario, procedimento, data_registro) VALUES(:id_atendimento, :id_usuario, :procedimento, :data_registro)";
    if ($procedimento == "") {
        echo 'O texto do procedimento não pode ficar em branco!';
    } else {
        try {
            $statement = $db->prepare($query);
            $statement->execute(array(
                ':id_atendimento' => $id_atendimento,
                ':id_usuario' => $id_usuario,
                ':procedimento' => $procedimento,
                ':data_registro' => date("Y-m-d H:i:s")
            ));
//echo $statement->rowCount();
            echo 'Procedimento inserida com sucesso!';
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

function get_atendimento() {
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
//echo $id_atendimento;
    $query = "SELECT i.id_interessado,i.nome as interessado, a.assunto
              FROM atendimento a 
              INNER JOIN interessado i ON i.id_interessado = a.id_interessado 
              where a.id_atendimento =" . $id_atendimento;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);

    $rowCount = $statement->rowCount();
//print_r($rowCount);

    if ($rowCount > 0) {
        echo $json;
    } else {
        echo '0';
    }
}

function all_procedimento() {
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
//echo $id_atendimento;
    $query = "SELECT p.*,u.nome 
FROM procedimento p
INNER JOIN usuario u ON u.id_usuario = p.id_usuario
where p.id_atendimento =" . $id_atendimento . " order by data_registro DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
//echo $json;

    $rowCount = $statement->rowCount();
//print_r($rowCount);

    if ($rowCount > 0) {
        echo '{"procedimentos":' . json_encode($result) . '}';
    } else {
        echo '0';
    }
}

function finaliza_atendimento() {
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
    $sql_status = 'UPDATE atendimento SET status ="1" WHERE id_atendimento=' . $id_atendimento;
    $stm_status = $db->prepare($sql_status);
    $stm_status->execute();
    $rowCount = $stm_status->rowCount();

    if ($rowCount > 0) {
        session_start();
        $id_usuario = $_SESSION['usuarioID'];
        $query = "INSERT INTO procedimento (id_atendimento, id_usuario, procedimento, data_registro) VALUES(:id_atendimento, :id_usuario, :procedimento, :data_registro)";
        $statement = $db->prepare($query);
        $statement->execute(array(
            ':id_atendimento' => $id_atendimento,
            ':id_usuario' => $id_usuario,
            ':procedimento' => 'Finalizou atendimento',
            ':data_registro' => date("Y-m-d H:i:s")
        ));
        echo json_encode(array("status" => TRUE,
            "mensagem" => 'Atendimento finalizado e arquivado com sucesso',
            'id_atendimento' => $id_atendimento));
    } else {
        echo json_encode(array("status" => FALSE,
            "mensagem" => 'Não foi possível realizar o arquivamento do atendimento',
            'id_atendimento' => $id_atendimento));
    }
}

function reativa_atendimento() {
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
    $sql_status = 'UPDATE atendimento SET status =0 WHERE id_atendimento=' . $id_atendimento;
    $stm_status = $db->prepare($sql_status);
    $stm_status->execute();
    $rowCount = $stm_status->rowCount();

    if ($rowCount > 0) {
        session_start();
        $id_usuario = $_SESSION['usuarioID'];
        $query = "INSERT INTO procedimento (id_atendimento, id_usuario, procedimento, data_registro) VALUES(:id_atendimento, :id_usuario, :procedimento, :data_registro)";
        $statement = $db->prepare($query);
        $statement->execute(array(
            ':id_atendimento' => $id_atendimento,
            ':id_usuario' => $id_usuario,
            ':procedimento' => 'Reativou atendimento',
            ':data_registro' => date("Y-m-d H:i:s")
        ));
        echo json_encode(array("status" => TRUE,
            "mensagem" => 'Atendimento reativado com sucesso',
            'id_atendimento' => $id_atendimento));
    } else {
        echo json_encode(array("status" => FALSE,
            "mensagem" => 'Não foi possível realizar a reativação do atendimento',
            'id_atendimento' => $id_atendimento));
    }
}

function goLogin() {
//echo 'acessou goLogin';    
    global $db;
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = 'SELECT * FROM usuario WHERE username= :username and password= :password';
    $stm = $db->prepare($sql);
    $stm->bindValue(':username', $username, PDO::PARAM_STR);
    $stm->bindValue(':password', $password, PDO::PARAM_STR);
    $stm->execute();

    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);

    $rowCount = $stm->rowCount();
//echo $rowCount;

    if ($rowCount < 1) {

        echo json_encode(array("status" => FALSE,
            "mensagem" => 'Não foi possivel realizar o login'));
    } else {
        echo json_encode(array("status" => TRUE,
            "mensagem" => 'Login realizado com sucesso'
        ));
        if (!isset($_SESSION)) {  //verifica se há sessão aberta


            /* Define o limitador de cache para 'private' */
            session_cache_limiter('private');
//$cache_limiter = session_cache_limiter();

            /* Define o limite de tempo do cache em 30 minutos */
            session_cache_expire(60);
//$cache_expire = session_cache_expire();
            session_start();  //Inicia seção

            $_SESSION['usuarioID'] = $dados[0]['id_usuario'];
            $_SESSION['nomeUsuario'] = $dados[0]['nome'];
            $_SESSION['email'] = $dados[0]['email'];
            $_SESSION['horarioSalvo'] = time();
            exit;
        }
    }
}

function goLogout() {
    session_start();
    session_destroy();
    header("Location: /secint/login.php");
    ;
    exit;
    echo 'Logout realizado com sucesso';
}

function save_interessado() {
    session_start();
    global $db;
//$id_atendimento = $_REQUEST['id_atendimento'];
    $id_usuario = $_SESSION['usuarioID'];
    $nome = $_REQUEST['interessado'];
    $matricula = $_REQUEST['matricula'];
    $email = $_REQUEST['email'];
    $fone_residencial = $_REQUEST['fone_residencial'];
    $fone_celular = $_REQUEST['fone_celular'];
    $categoria = $_REQUEST['categoria'];
    $nome_curso = $_REQUEST['curso'];
    $data_registro = date("Y-m-d H:i:s");

    $query = "INSERT INTO interessado (nome, matricula, email, fone_residencial, fone_celular, nome_curso, status, categoria, usuario, data_registro) VALUES(:nome, :matricula, :email, :fone_residencial, :fone_celular, :nome_curso, :status, :categoria,  :usuario, :data_registro)";
    if ($nome == "") {
        echo 'O nome do interessado não pode ficar em branco!';
    } else {
        try {
            $statement = $db->prepare($query);
            $statement->execute(array(
                ':nome' => $nome,
                ':matricula' => $matricula,
                ':email' => $email,
                ':fone_residencial' => $fone_residencial,
                ':fone_celular' => $fone_celular,
                ':nome_curso' => $nome_curso,
                ':categoria' => $categoria,
                ':status' => 1,
                ':usuario' => $id_usuario,
                ':data_registro' => date("Y-m-d H:i:s")
            ));
//echo $statement->rowCount();
            echo json_encode(array("status" => TRUE,
                "mensagem" => 'Interessado inserido com sucesso!'));
        } catch (PDOException $e) {
            echo json_encode(array("status" => FALSE,
                "mensagem" => 'Não foi possível incluir o interessado' . $e->getMessage()));
//echo 'Error: ' . $e->getMessage();
        }
    }
}

function get_interessado() {
    global $db;
    $id_interessado = $_REQUEST['id_interessado'];
    $sql = "SELECT * FROM interessado WHERE id_interessado = :id_interessado";
    $statement = $db->prepare($sql);
    $statement->bindValue(':id_interessado', $id_interessado, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
}

function priorizarAtendimento() {
    global $db;
    $id_atendimento = $_REQUEST['id_atendimento'];
//echo $id_atendimento;
    $prioridade = $_REQUEST['prioridade'];
//echo $prioridade;
    $sql_prioridade = 'UPDATE atendimento SET prioridade="' . $prioridade . '" WHERE id_atendimento=' . $id_atendimento;
//print_r($sql_prioridade);
    $stm_prioridade = $db->prepare($sql_prioridade);
    $stm_prioridade->execute();
    $rowCount = $stm_prioridade->rowCount();

    if ($rowCount > 0) {
        session_start();
        $id_usuario = $_SESSION['usuarioID'];
        $query = "INSERT INTO procedimento (id_atendimento, id_usuario, procedimento, data_registro) VALUES(:id_atendimento, :id_usuario, :procedimento, :data_registro)";
        $statement = $db->prepare($query);
        $statement->execute(array(
            ':id_atendimento' => $id_atendimento,
            ':id_usuario' => $id_usuario,
            ':procedimento' => 'Alterou a prioridade para <b><u>' . $prioridade.'</u></b>',
            ':data_registro' => date("Y-m-d H:i:s")
        ));
        echo json_encode(array("status" => TRUE,
            "mensagem" => 'Prioridade alterada com sucesso com sucesso',
            'id_atendimento' => $id_atendimento));
    } else {
        echo json_encode(array("status" => FALSE,
            "mensagem" => 'Não foi possível realizar o arquivamento do atendimento',
            'id_atendimento' => $id_atendimento));
    }
}

function AssuntoByInteressado() {
    global $db;
    $term = $_REQUEST['term'];
    $sql = "SELECT * FROM atendimento WHERE id_interessado=:interessado ORDER BY assunto ASC";
    $stm = $db->prepare($sql);
    $stm->bindValue(':interessado', $term, PDO::PARAM_STR);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_OBJ);
    $atendimento = 'Assuntos: <br>';
    foreach ($dados as $reg):
        //$atendimento = '<center><a href=\"#\" onclick=\"get_atendimento(' . $reg->id_atendimento . ')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Atendimento\" class=\"btn btn-success\"><i class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></i></a></center>';
        $atendimento .= '<a href="#" class="btn btn-link" role="button" onclick="get_atendimento(' . $reg->id_atendimento . ')">' . $reg->assunto . '</a>';
    endforeach;
    $atendimento .= '<a href="#" class="btn btn-info" role="button" onclick="novo_assunto()">Novo Assunto</a> ';
    echo json_encode($atendimento);
}
