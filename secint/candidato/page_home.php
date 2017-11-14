<?php
verifica();
?>
<div class="wrapper" role="main">
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <?php
                if (isset($_GET['mensagem'])) {
                    $mensagem = unserialize($_GET['mensagem']);
                    echo $mensagem;
                }
                ?>
            </div>
        </div>                
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Página incial
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    echo "<b>" . utf8_encode($_SESSION['nome']) . "</b>,<br><br>"
                    . "Bem vindo ao sistema de controle de seleção do Programa de Pós-Graduação em Ciência da Computação."
                    . "<br>"
                    . " Seu perfil no sistema é ";
                    
                    $vars = [$_SESSION['perfil']];
                    $sql = "select * from perfil where id_perfil =?";
                    $perfil = get_data($sql, $vars);
                    //var_dump($perfil);
                    echo "<b>" . utf8_encode($perfil[0]['descricao']) . "</b> "
                    . "o que permite " . utf8_encode($perfil[0]['quesitos']) . "."
                    . "<br>"
                    . " Para a realização da avaliação acesse o cadastro do candidato e informe as respectivas notas."
                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>