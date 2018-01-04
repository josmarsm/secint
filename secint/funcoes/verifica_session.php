<?php
session_start();
$horarioAtual = Time();
$contagem = $horarioAtual - $_SESSION['horarioSalvo'];

if ($contagem > (5 * 60 * 100)) {    
    echo json_encode(array("status" => FALSE,"contagem" => $contagem,
            "mensagem" => 'Sessão expirada'));
} //Coloque aqui o codigo para encerrar a sessao
else {
    echo json_encode(array("status" => TRUE,"contagem" => $contagem,
            "mensagem" => 'Sessão ativa'));
}

//Atualiza a variavel do horario salvo para o horario atual
//$_SESSION['horarioSalvo'] = $horarioAtual;