<?php

include_once '../funcoes/config.php';
require_once '../funcoes/class.phpmailer.php';
require_once '../funcoes/class.smtp.php';

$acao = $_REQUEST['acao'];
echo $acao;
$data_atual = new DateTime();
$data_final = new DateTime('2017-11-14 18:00:00');
$dia_atual = new DateTime('2017-11-09 14:00:00');
$intervalo = $data_atual->diff($data_final);
//print_r($intervalo);
$tempo = $intervalo->d . ' dias, ';
$tempo .= $intervalo->h . ' horas, ';
$tempo .= $intervalo->i . ' minutos.';

//var_dump($dia_atual->diff($data_final));
function avaliacao_pendente($tempo) {
    global $db;
    //$sql_orientador = "SELECT * FROM usuario";
    $sql_consulta = "SELECT c.comissao_avaliador,
  Count(DISTINCT c.id_candidato) AS total_candidatos,
  Sum(CASE WHEN c.status_fase1 > 0 THEN 1 ELSE 0 END) AS total_avaliados,
  u.nome,
  u.email
FROM candidato c INNER JOIN usuario u ON u.id_usuario = c.comissao_avaliador
GROUP BY
  c.comissao_avaliador,
  u.nome,
  u.email";
    //print_r($sql_consulta);
    //$stm_orientador = $db->query($sql_orientador);
    $stm_consulta = $db->query($sql_consulta);
    //print_r($stm_consulta);
    //$result_orientador = $stm_orientador->fetchAll();
    $result_consulta = $stm_consulta->fetchAll();
    //print_r($result_consulta);
    foreach ($result_consulta as $row_consulta) {
        $nome_avaliador = $row_consulta['nome'];
        $email = $row_consulta['email'];
        $total_candidatos = $row_consulta['total_candidatos'];
        $total_avaliados = $row_consulta['total_avaliados'];
        $nao_avaliados = ($total_candidatos - $total_avaliados);
        
        if ($nao_avaliados == 0) {
            $nao_avaliados_mensagem = 'Todos foram avaliados, obrigado pela colaboração.';
        } else {
            $nao_avaliados_mensagem = 'Destes, ' . $nao_avaliados . ' ainda não foram avaliados.<br>';
            $nao_avaliados_mensagem .= 'Para realizar a avaliação acesse o endereço wwww.ufsm.br/pgcc/selecao<br>';
            $nao_avaliados_mensagem .= 'Faltam apenas ' . $tempo . ' para a divulgação dos resultados da primeira fase<br>';
        }

        if ($total_candidatos > 0) {
            $mensagem = '<pre>';
            $mensagem .= 'Prezado avaliador [' . $nome_avaliador . '] ,<br>';
            $mensagem .= 'Na rotina automática de verificação do sistema a seguinte situação foi encontrada:<br>';
            $mensagem .= 'Foram designados ' . $total_candidatos . ' candidatos para sua avalicação. ';
            $mensagem .= $nao_avaliados_mensagem;
            $mensagem .= '</pre>';

            $nome_destinatario = $nome_avaliador;
            $destinarario = $email;
            $to = 'josmar@inf.ufsm.br';
            $assunto = 'Sistema de Selecao do PGCC - Verificação automática';
            $assunto = '=?UTF-8?B?' . base64_encode($assunto) . '?=';
            
            if ($nao_avaliados == 0) {
            enviar_email($to, $assunto, $mensagem, $nome_destinatario); //teste
            }
                        
            $relatorio = 'Foi enviado mensagem para ' . $nome_destinatario . ' com o seguinte email ' . $destinarario . '<br>';
            $relatorio .= 'Com o seguinte assunto: ' . $assunto . '<br>';
            $relatorio .= 'Com a seguinte mensagem: ' . $mensagem . '<br>';
            $relatorio .= 'Dados complementares: Total de candidatos ' . $total_candidatos . ' avaliados ' . $total_avaliados . ' nao avaliados ' . $nao_avaliados . '<br>';
            $relatorio .= '<hr>';
        }
        $mensagem_relatorio .= $relatorio;
    }

    $email_relatorio = 'josmar@inf.ufsm.br';
    $assunto_relatorio = 'Relatório de envio de emails do sistema de seleção';
    $assunto_relatorio = '=?UTF-8?B?' . base64_encode($assunto_relatorio) . '?=';
    $nome_destinatario_relatorio = 'Josmar Nuernberg';
    enviar_email($email_relatorio, $assunto_relatorio, $mensagem_relatorio, $nome_destinatario_relatorio);
    return;
}

function enviar_email($email_to, $assunto, $mensagem, $nome_destinatario) {

    //require_once("class.phpmailer.php");
    //require_once("class.smtp.php");
    $de = 'pgcc@ufsm.br';
    //$de_nome = 'Programa de Pós-Graduação em Ciência da Computação';
    $from_nome = '=?UTF-8?B?' . base64_encode('Programa de Pós-Graduação em Ciência da Computação') . '?=';
    $username = 'pgcc@ufsm.br';
    $password = 'pgccSHA256';


    try {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // Define que a mensagem será SMTP        
// envia email HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->SMTPDebug = 0;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->SMTPSecure = 'ssl'; // SSL REQUERIDO pelo GMail
        $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
        $mail->Port = 465; //  Usar 587 porta SMTP
        $mail->Username = $username; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = $password; // Senha do servidor SMTP (senha do email usado)

        $mail->SetFrom($de, $from_nome);
        $mail->AddReplyTo($de, $from_nome);
        //$mail->AddCC('josmar@inf.ufsm.br', 'Josmar Nuernberg'); // Copia

        $mail->Subject = $assunto;


        $mail->MsgHTML($mensagem);

        $mail->AddAddress($email_to);

        $mail->Send();
        echo '<p>Mensagem enviada com sucesso para ' . $nome_destinatario . '</p>';

//caso apresente algum erro é apresentado abaixo com essa exceção.
    } catch (phpmailerException $e) {
        echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
    }
}

//echo $contador; 
//echo '<br>';

avaliacao_pendente($tempo);
