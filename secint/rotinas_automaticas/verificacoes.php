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

function avaliacao_pendente($tempo) {
    global $db;
    $sql_consulta = 'SELECT c.comissao_avaliador, Count(DISTINCT c.id_candidato) AS total_candidatos, Sum(CASE WHEN c.status_fase1 > 0 THEN 1 ELSE 0 END) AS total_avaliados,
            u.nome, u.email
            FROM candidato c INNER JOIN usuario u ON u.id_usuario = c.comissao_avaliador
            GROUP BY
           c.comissao_avaliador, u.nome, u.email';

    $stm_consulta = $db->query($sql_consulta);
    $result_consulta = $stm_consulta->fetchAll();
    foreach ($result_consulta as $row_consulta) {
        $nome_avaliador = $row_consulta['nome'];
        $email = $row_consulta['email'];
        $total_candidatos = $row_consulta['total_candidatos'];
        $total_avaliados = $row_consulta['total_avaliados'];
        $nao_avaliados = ($total_candidatos - $total_avaliados);

        if ($total_candidatos > 0) {
            $mensagem = '<pre>';
            $mensagem .= 'Prezado avaliador [' . $nome_avaliador . '] ,<br>';
            $mensagem .= 'Na rotina automática de verificação do sistema a seguinte situação foi encontrada:<br>';
            $mensagem .= 'Foram designados ' . $total_candidatos . ' candidatos para sua avalicação. ';
            $mensagem .= 'Destes, ' . $nao_avaliados . ' ainda não foram avaliados.<br>';
            $mensagem .= 'Para realizar a avaliação acesse o endereço wwww.ufsm.br/pgcc/selecao<br>';
            $mensagem .= 'Faltam apenas ' . $tempo . ' para a divulgação dos resultados da primeira fase<br>';
            $mensagem .= '</pre>';

            $destinarario = $email;
            //$destinarario = 'josmar@inf.ufsm.br';

            $nome_destinatario = $nome_avaliador;

            $assunto = 'Sistema de Selecao do PGCC - Verificação automática';
            $assunto = '=?UTF-8?B?' . base64_encode($assunto) . '?=';

            $relatorio = '';
            if ($nao_avaliados > 0) {
                enviar_email($destinarario, $assunto, $mensagem, $nome_destinatario); //teste

                $relatorio .= 'Foi enviado mensagem para ' . $nome_destinatario . ' com o seguinte email ' . $destinarario . '<br>';
                $relatorio .= 'Com o seguinte assunto: ' . $assunto . '<br>';
                $relatorio .= 'Com a seguinte mensagem: ' . $mensagem . '<br>';
                $relatorio .= 'Dados complementares: Total de candidatos ' . $total_candidatos . ' avaliados ' . $total_avaliados . ' nao avaliados ' . $nao_avaliados . '<br>';
            } else {
                $relatorio .= 'Não foi enviado mensagem para ' . $nome_destinatario . ' porque avaliou todos os candidatos <br>';
            }
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

    $de = 'pgcc@ufsm.br';
    $from_nome = '=?UTF-8?B?' . base64_encode('Programa de Pós-Graduação em Ciência da Computação') . '?=';
    $username = 'pgcc@ufsm.br';
    $password = 'pgccSHA256';

    try {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // Define que a mensagem será SMTP        
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

    } catch (phpmailerException $e) {
        echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
    }
}

avaliacao_pendente($tempo);
