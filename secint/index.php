<?php
require_once './funcoes/funcoes.php';
verificaLogin();
/*
  foreach ($_SESSION as $key => $value) {
  print($key.' - '.$value.'<br>');
  }
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Sec Int 1.0 - Sistema de Controle de Atendimentos</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>   
        <link href="media/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link href="media/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

        <link href="media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" >        
        <link href="media/css/jquery-ui.css" rel="stylesheet" type="text/css" />

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="media/js/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="media/js/jquery-ui.min.js"></script>
        <script src="https://cdn.datatables.net/s/dt/dt-1.10.10/datatables.min.js" type="text/javascript" ></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="media/js/bootstrap.js"></script>
        <script src="https://cdn.rawgit.com/vedmack/yadcf/28986f6f95cc9ce28ac1ead3035c20e8df506043/jquery.dataTables.yadcf.js"></script>
        <script src="media/js/atendimento.js"></script>  
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>     

        <script>
            function limite(obj) {
                var max = 35;
                if (obj.value.length > max) {
                    alert("O máximo de caracteres é 35. Seja mais suscinto e reescreva o assuntor utilizando palavras chaves    .");
                    return false;
                } else
                    return true;
            }
        </script>
    </head>
    <body onLoad="loadAtedimento();">

        <div id="navbar" class="container-fluid">    
            <nav class="navbar navbar-default navbar-static-top" role="navigation">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">SEC Int 1.0</a>
                </div>
                <div class="    collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">                    
                        <li class="active"><a href="?p=atendimento">Atendimentos</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>                         
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="cadastrar_interessado()" >Interessado</a></li>
                                <li><a href="?p=cadastro">Assunto</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consulta <b class="caret"></b></a>                         
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="loadAtedimento()">Atendimentos não finalizados</a></li>
                                <li><a href="#" onclick="loadAtedimento('Finalizado')">Atendimentos finalizados</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Relatórios</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><b><?php echo $_SESSION['nomeUsuario'] ?></b></a></li>
                        <li><a href="#" onclick="perfil()"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                        <li><a href="#" onclick="goLogout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div id='mensagem'>            
        </div>
        <div class="container-fluid">
            <?php
            carrega_pagina();
            ?>
        </div>
    </body>
</html>