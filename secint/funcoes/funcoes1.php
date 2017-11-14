<?php

ini_set('display_errors', TRUE);
error_reporting(E_ALL); //PHP > 5 mas diferente de 5.3.X 
error_reporting(E_ALL | E_STRICT); // Exclusivamente PHP 5.3.x
//print '<pre>';
//print_r($GLOBALS);
//print '</pre>';

include 'config.php';

$server = $_SERVER['SERVER_NAME'];
//echo $server;
//Se a variavel $server retornar localhost
if ($server == "localhost")
    $url = "http://localhost/selecao";
//Caso contrário recebe a url do servidor
else
    $url = "http://ufsm.br/pgcc/selecao";
//echo $url;

define('site', $url);
define('usuario_id','1');

$error = array();
$resp = array();

$f = isset($_GET['f']) ? $_GET['f'] : null;

if ($f == "signup") {
    signup();
}

if ($f == "login") {
    login();
}

if ($f == "logout") {
    logout();
}

if ($f == "add_identificacao") {
    add_identificacao();
}

if ($f == "upload") {
    upload_file();
}

function signup() {
    $error = 0;
    $resp['msg'] = '';

//$msg = & $conteudo['msg'];

    $fullname = isset($_POST["fullname"]);
    $email = isset($_POST["email"]);
    $add_username = isset($_POST["add_username"]);
    $add_password = isset($_POST["add_password"]);
    $re_password = isset($_POST["re_password"]);
//print_r($fullname.$email);

    $var_email = [$email];
    $data_email = get_data("SELECT * FROM usuario WHERE email= ? ", $var_email);
    if (count($data_email) > 0) {
        ++$error;
//$msg['email'] = 'Este email já está cadastrado cadastrado no sistema<br>';
        $resp['msg'] = "Este email já está cadastrado cadastrado no sistema<br>";
    }

    $var_username = [$add_username];
    $data_username = get_data("SELECT * FROM usuario WHERE username= ? ", $var_username);
    if (count($data_username) > 0) {
        ++$error;
//$msg['username'] = 'Este username já está cadastrado cadastrado no sistema';
        $resp['msg'] = "Este username já está cadastrado cadastrado no sistema";
    }

    if ($add_password != $re_password) {
        ++$error;
        $resp['msg'] = 'As senhas digitadas não são iguais<br>';
    }

    if ($error <= 0) {
        $resp['msg'] = 'Cadastro realizado com sucesso!<br>';
        date_default_timezone_set('America/Sao_Paulo');
        $data_alteracao = date('Y-m-d H:i');
        $perfil = '5';
        $vars = [$fullname,
            $email,
            $add_username,
            $add_password,
            $perfil,
            $data_alteracao];
        print_r($vars);
        $sql = 'INSERT INTO usuario (
        nome,
        email,
        username,
        password, 
        perfil,
        ultimo_acesso)
            VALUES
            (?,?,?,?,?,?)';

        $data = set_data($sql, $vars);
//print_r($data);
        $alerta = $resp;
//$alerta = $conteudo;
        $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta . '</div>';
//header("refresh:2, login.php");
    } else {

        $alerta = $conteudo;
        $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta . '</div>';
    }
//print_r($resp);

    print_r($mensagem);
    print_r($conteudo);
}

function carrega_pagina() {
    (isset($_GET['p'])) ? $pagina = $_GET['p'] : $pagina = 'home';
    if (file_exists('page_' . $pagina . '.php')):
        require_once ('page_' . $pagina . '.php');
    else:
        require_once ('page_home.php');
    endif;
}

function gera_titulos() {
    (isset($_GET['p'])) ? $pagina = $_GET['p'] : $pagina = 'home';
    switch ($pagina):
        case 'home':
            $titulo = 'Home - Sistema de Seleção';
            break;
        case 'candidatos':
            $titulo = 'Candidatos - Sistema de Seleção';
            break;
        case 'comissao':
            $titulo = 'Comissao - Sistema de Seleção';
            break;
        case 'orientadores':
            $titulo = 'Orientadores - Sistema de Seleção';
            break;
        default:
            $titulo = 'Seleção - Sistema de Seleção';
            break;
    endswitch;
    return $titulo;
}

function verifica() {
    if (!isset($_SESSION)) {
        session_start();
    }
//session_start();
    if ((!isset($_SESSION['username']) == true) and ( !isset($_SESSION['password']) == true)) {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        header('location:login.php');
    }
    $logado = $_SESSION['username'];
}

function logout() {
    session_start();
    session_destroy();
    session_commit();

    $resp['status'] = true;
    $resp['msg'] = "Logout realizado com sucesso!";
    echo json_encode($resp);
    header("Location:/selecao", 10);
    exit;
//Caso o usuário não estejand autenticado, limpa os dados e redireciona
    if (!isset($_SESSION['username']) and ! isset($_SESSION['password'])) {
//Destrói
        session_start();
        session_destroy();
        session_commit();

//Limpa
//unset($_SESSION['username']);
//unset($_SESSION['password']);
//Redireciona para a página de autenticação
//header('location:login.php');
    }
}

function login() {
//$error = 0;
//$resp['msg'] = '';

    session_start();
//$username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
//$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
//$usuario = $_POST["username"];


    $username = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : FALSE;
// Recupera a senha, a criptografando em MD5 
//$password = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE;
    $password = isset($_POST["password"]) ? addslashes(trim($_POST["password"])) : FALSE;
    echo '$username ' . $username . ' - $password ' . $password;
// Usuário não forneceu a senha ou o login 
    if (!$username) {
        $error['username'] = "Username não informado!";
    }

    if (!$password) {
        $error['password'] = "Password não informada!";
    }

    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = 'false';
        $alerta = $resp;
        if (isset($alerta[msg]['username']) && isset($alerta[msg]['password'])) {
            $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta[msg]['username'] . '<br>' . $alerta[msg]['password'] . '</div>';
        } elseif (isset($alerta[msg]['username'])) {
            $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta[msg]['username'] . '</div>';
        } elseif (isset($alerta[msg]['password'])) {
            $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta[msg]['password'] . '</div>';
        }
//header("location: login.php?mensagem=" . serialize($mensagem));
        exit;
        return;
    }

    $vars = [$username];
    $data = get_data("SELECT * FROM usuario WHERE username = ? ", $vars);
    print_r($data);
    count($data);
    $total = count($data);
// Caso o usuário tenha digitado um login válido o número de linhas será 1.. 
    if ($total >= 1) {
// Agora verifica a senha 
        if ($password == $data[0]['password']) {
// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
            $_SESSION["id_usuario"] = $data[0]['id_usuario'];
            $_SESSION["nome"] = stripslashes($data[0]['nome']);
            $_SESSION["email"] = stripslashes($data[0]['email']);
            $_SESSION["username"] = stripslashes($data[0]['username']);
            $_SESSION["perfil"] = stripslashes($data[0]['perfil']);
            $_SESSION["status"] = stripslashes($data[0]['status']);
            $_SESSION["ultimo_acesso"] = stripslashes($data[0]['ultimo_acesso']);

            

            $resp['status'] = true;
            $resp['msg'] = "Login realizado com sucesso!";
            echo json_encode($resp);

            header("Location: index.php");
            exit;
        }
// Senha inválida 
        else {
            $resp['status'] = false;
            $resp['msg'] = 'Password inválida!';
            $alerta = $resp;
            $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta[msg] . '</div>';

            header("location: login.php?mensagem=" . serialize($mensagem));
            exit;
        }
    }
// Login inválido 
    else {
        $resp['status'] = false;
        $resp['msg'] = 'Username inexistente!';
        $alerta = $resp;
        $mensagem = '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">' . $alerta[msg] . '</div>';
        header("location: login.php?mensagem=" . serialize($mensagem));
        exit;
    }
}

function set_data($sql, $vars = null) {
    global $db;

    $stmt = $db->prepare($sql);
    $stmt->execute($vars);
}

function get_data($sql, $vars = null) {
    global $db;

    $stmt = $db->prepare($sql);
    $stmt->execute($vars);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function get_data_all($sql) {
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function displayAlert($text, $type) {
    echo "<div class=\"alert alert-" . $type . "\" role=\"alert\">
        <p>" . $text . "</p>
      </div>";
}

function add_identificacao() {
    $id_usuario = isset($_GET["id"]) ? addslashes(trim($_GET["id"])) : FALSE;
    $inscricao = isset($_POST["inscricao"]) ? addslashes(trim($_POST["inscricao"])) : FALSE;
    $linha_pesquisa_1 = isset($_POST["linha_pesquisa_1"]) ? addslashes(trim($_POST["linha_pesquisa_1"])) : FALSE;
    $linha_pesquisa_2 = isset($_POST["linha_pesquisa_2"]) ? addslashes(trim($_POST["linha_pesquisa_2"])) : FALSE;
    $orientador_1 = isset($_POST["orientador_1"]) ? addslashes(trim($_POST["orientador_1"])) : FALSE;
    $orientador_2 = isset($_POST["orientador_2"]) ? addslashes(trim($_POST["orientador_2"])) : FALSE;
    $orientador_3 = isset($_POST["orientador_3"]) ? addslashes(trim($_POST["orientador_3"])) : FALSE;
    $poscomp = isset($_POST["poscomp"]) ? addslashes(trim($_POST["poscomp"])) : FALSE;
    if ($poscomp == 'Sim') {
        $ano_poscomp = isset($_POST["ano_poscomp"]) ? addslashes(trim($_POST["ano_poscomp"])) : FALSE;
        $nota_poscomp = isset($_POST["nota_poscomp"]) ? addslashes(trim($_POST["nota_poscomp"])) : FALSE;
    } else {
        $ano_poscomp = null;
        $nota_poscomp = null;
    }
    $bolsa = isset($_POST["bolsa"]) ? addslashes(trim($_POST["bolsa"])) : FALSE;
    date_default_timezone_set('America/Sao_Paulo');
    $data_alteracao = date('Y-m-d H:i');

    $vars = [$id_usuario,
        $inscricao,
        $linha_pesquisa_1,
        $linha_pesquisa_2,
        $orientador_1,
        $orientador_2,
        $orientador_3,
        $poscomp,
        $ano_poscomp,
        $nota_poscomp,
        $bolsa,
        $data_alteracao];
    print_r($vars);
    $sql = 'INSERT INTO identificacao (
        id_usuario,
        inscricao,
        linha_pesquisa_1, 
        linha_pesquisa_2,
        orientador_1,
        orientador_2, 
        orientador_3, 
        poscomp,
        ano_poscomp, 
        nota_poscomp,
        bolsa,
        data_alteracao)
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?)';

    $data = set_data($sql, $vars);
    print_r($data);

    $vars = [$id_usuario];
    $email_usuario = get_data("SELECT * FROM usuario WHERE id_usuario = ?", $vars);
//print_r($email_usuario);
    $nome_to = $email_usuario[0]['nome'];
    $email_to = $email_usuario[0]['email'];

    $assunto = '[Processo PGCC 2018] - Ficha de Identificacao';

    if ($poscomp == "Sim") {
        $complemento_poscomp = ' - [Ano ' . $ano_poscomp . '- Pontuação ' . $nota_poscomp . ']';
    }

    $mensagem = 'Prezado, <b>' . $nome_to . '</b>,<br><br>';
    $mensagem .= 'Voce realizou informou os seguintes dados no sistema de seleção para a Ficha de Identificação: <br>';
    $mensagem .= 'Linha de Pesquisa 1: ' . $linha_pesquisa_1 . '<br>';
    $mensagem .= 'Linha de Pesquisa 2: ' . $linha_pesquisa_2 . '<br>';
    $mensagem .= 'Orientador 1: ' . $orientador_1 . '<br>';
    $mensagem .= 'Orientador 2: ' . $orientador_2 . '<br>';
    $mensagem .= 'Orientador 3: ' . $orientador_3 . '<br>';

    if ($poscomp == "Sim") {
        $complemento_poscomp = ' - [Ano ' . $ano_poscomp . '- Pontuação ' . $nota_poscomp . ']';
    }

    $mensagem .= 'Poscomp: ' . $poscomp . $complemento_poscomp . '<br>';
    $mensagem .= 'Bolsa: ' . $bolsa . '<br>';

    $header = site . '/candidato/?p=identificacao&?id=' . $id_usuario;

    header('Location: ' . $header);

    enviar_email($email_to, $assunto, $mensagem);
}

function enviar_email($email_to, $assunto, $mensagem) {

    require_once("class.phpmailer.php");
    require_once("class.smtp.php");
    $de = 'pgcc@ufsm.br';
    $de_nome = 'Programa de Pós-Graduação em Ciência da Computação';
    $username = 'pgcc@ufsm.br';
    $password = 'pgccSHA256';


    try {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // Define que a mensagem será SMTP        
// envia email HTML
        $mail->isHTML(true);
        $mail->CharSet = "utf-8";

        $mail->SMTPDebug = 0;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->SMTPSecure = 'ssl'; // SSL REQUERIDO pelo GMail
        $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
        $mail->Port = 465; //  Usar 587 porta SMTP
        $mail->Username = $username; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = $password; // Senha do servidor SMTP (senha do email usado)

        $mail->SetFrom($de_nome, $de);

        $mail->Subject = $assunto;

        $mail->MsgHTML($mensagem);
        $mail->AddAddress($email_to);

        $mail->Send();
        echo "Mensagem enviada com sucesso</p>\n";

//caso apresente algum erro é apresentado abaixo com essa exceção.
    } catch (phpmailerException $e) {
        echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
    }
}

function upload_file() {

    $nome = isset($_POST["$nome"]) ? addslashes(trim($_POST["$nome"])) : FALSE;

    echo 'id do candidato' . $id_candidato . '<br>';
    echo 'id do subcritério' . $id_subcriterio . '<br>';
    echo 'id do nome do arquivo' . $nome . '<br>';
    echo 'id do pontuação' . $pontuacao . '<br>';

    /*
      if(isset($_FILES['fileUpload']))
      {
      date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo

      $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
      $dir = 'uploads/'; //Diretório para uploads

      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
      }
     * 
     */
}

function create_grid_upload() {
    echo '<h4>Documentos anexados:</h4>'
    . '<table class = "table table-hover table-bordered table-striped" flow-transfers>'
    . '<thead>'
    . '<tr>'
    . '<th>#</th>'
    . '<th>Nome documento</th>'
    . '<th>Relative Path</th>'
    . '<th>Nota solicitada</th>'
    . '<th>Nota validada</th>'
    . '<th>Vizualizar</th>'
    . '</tr>'
    . '</thead>'
    . '<tbody>'
    . '<tr ng-repeat="file in transfers">'
    . '<td>{{$index + 1}}</td>'
    . '<td>{{file.name}}</td>'
    . '<td>{{file.relativePath}}</td>'
    . '<td>{{file.paused}}</td>'
    . '<td>{{file.isUploading()}}</td>'
    . '<td>'
    . '<div class = "btn-group">'
    . '<a class = "btn btn-mini btn-warning" ng-click = "file.pause()" ng-hide = "file.paused">'
    . 'Pause'
    . '</a>'
    . '</div>'
    . '</td>'
    . '</tr>'
    . '</tbody>'
    . '</table>';
}

function status_aplicacao($codigo_aplicacao) {
    $vars = [$codigo_aplicacao];
//print_r($vars);
//$vars = [1];
//print_r($vars);
    $sql_habilitacao = "select * from prazo_habilitacao where codigo_aplicacao=?";
    $habilitacao = get_data($sql_habilitacao, $vars);

    $DataAtual = new DateTime();
    $habilitacao_inicio = new DateTime($habilitacao[0]['inicio']);
    $habilitacao_fim = new DateTime($habilitacao[0]['fim']);
    $descricao = $habilitacao[0]['descricao'];

    $diferenca_inicio = $habilitacao_inicio->diff($DataAtual);
    $diferenca_fim = $DataAtual->diff($habilitacao_fim);

    //print_r($diferenca_inicio);
    //echo '<br>';
    //print_r($diferenca_fim);

    if ($habilitacao_inicio > $DataAtual) {
        $status = 'desativada';
        $mensagem = $descricao . ' ainda não habilitada, faltam: ';
        $mensagem .= $diferenca_inicio->y . ' anos, ';
        $mensagem .= $diferenca_inicio->m . ' meses, ';
        $mensagem .= $diferenca_inicio->d . ' dias, ';
        $mensagem .= $diferenca_inicio->h . ' horas, ';
        $mensagem .= $diferenca_inicio->i . ' minutos.';
    } elseif ($habilitacao_fim < $DataAtual) {
        $status = 'desativada';
        $mensagem = $descricao . ' foi desativada ha: ';
        $mensagem .= $diferenca_fim->y . ' anos, ';
        $mensagem .= $diferenca_fim->m . ' meses, ';
        $mensagem .= $diferenca_fim->d . ' dias, ';
        $mensagem .= $diferenca_fim->h . ' horas, ';
        $mensagem .= $diferenca_fim->i . ' minutos.';
    } else {
        $status = 'ativada';
        $mensagem = '';
    }
    return array($status, $mensagem);
}

//
//
//$date_time = new DateTime($DataAtual);
//$diff = $date_time->diff(new DateTime($DataFuturo));
//echo $diff->format('%y year(s), %m month(s), %d day(s), %H hour(s), %i minute(s) and %s second(s)');
// 0 year(s), 0 month(s), 0 day(s), 00 hour(s), 20 minute(s) and 0 second(s)

