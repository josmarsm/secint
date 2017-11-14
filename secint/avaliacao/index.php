<?php
require_once './../funcoes/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
        <?php
        //header('Content-Type: text/html; charset=ISO-8859-1', true);
        setlocale(LC_TIME, 'ptb');
        ?>
        <title><?php echo gera_titulos(); ?></title>
        <?php
        require_once './../funcoes/head.php';
        ?>
    </head>
    <body>

        <?php
        verifica();
        require_once 'hearder.php';
        carrega_pagina();


        require_once './../funcoes/foot.php';
        ?>
    </body>
</html>

