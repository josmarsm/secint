<?php
require_once './funcoes/verifica_login.php';
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
                var max=35; 
                if (obj.value.length > max) {
                    alert("O máximo de caracteres é 35. Seja mais suscinto e reescreva o assuntor utilizando palavras chaves    .");
                    return false;
                } else
                    return true;
            }
        </script>
    </head>
    <body onLoad="loadAtedimento();">

        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">SEC Int 1.0</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Atendimentos</a></li>
                    <li><a href="#">Cadastros</a></li>
                    <li><a href="#">Consulta</a></li>
                    <li><a href="#">Relatórios</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a><b><?php echo $_SESSION['nomeUsuario'] ?></b></a></li>
                    <li><a href="#" onclick="perfil()"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                    <li><a href="#" onclick="goLogout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
        <div id='mensagem'>            
        </div>
        <div class="container-fluid">
            <h1 align="center">Atendimentos não finalizados</h1>       
            <button 
                class="btn btn-primary menu"
                onclick="add_atendimento()">
                <i class="fa fa-user-plus"></i>
                Novo atendimento
            </button>

            <br><br>
            <div class="table-responsive">
                <table 
                    id="atendimento"
                    style="font-size: 10pt"
                    class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th style="text-align:center;">Curso</th>
                            <th style="text-align:center;">Interessado</th>
                            <th style="text-align:center;">Assunto</th>                        
                            <th style="text-align:center;">Atendente</th>                        
                            <th style="text-align:center;">Atendimentos</th>                        
                        </tr>
                    </thead>
                    <tbody>
                    </tbody> 
                </table> 
            </div>
            <div id="modal_atendimento" class="modal fade">
                <style>
                    .modal .modal-dialog { width: 850px;}                    
                </style>
                <div class="modal-dialog modal-lg">
                    <form action="#" id="form_atendimento" au tocomplete="off">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Novo Atendimento</h4>
                                <div id='info'></div>
                            </div>
                            <div class="modal-body">                                
                                <label id='label_interessado'>Interessado</label>
                                <input id="interessado" name="interessado" class="form-control txt-auto" />

                                <label id='label_assunto'>Assunto</label>
                                <input 
                                    onkeyup="limite(this)"
                                    id="assunto" name="assunto" class="form-control txt-auto"/>                              
                                <br>
                                <div id='fluxo' class="form-group" hidden="true">

                                    <div class="chat-panel panel panel-default">                                        
                                        <div class="panel-heading">
                                            <i class="fa fa-comments fa-fw"></i> Procedimentos
                                            <div class="input-group">
                                                <input id="textoProcedimento" type="text" class="form-control input-sm" placeholder="Escreva um novo procedimento ..." >
                                                <span class="input-group-btn">
                                                    <a class="btn btn-warning btn-sm" type="button" href="#" onclick="salva_procedimento()" id="salva_procedimento">Salva Procedimento</a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div id="procedimento"></div>                                                                   
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id_interessado" id="id_interessado" />
                                <input type="hidden" name="matricula" id="matricula" />                                
                                <button type="button" name='salvar_atendimento' id="salvar_atendimento" class="btn btn-success" onclick="salva_atendimento()">Salvar</button>
                                <button style="float: left;" type="button" name='finaliza_atendimento' id="finaliza_atendimento" class="btn btn-danger" onclick="finaliza_atendimento()">Finalizar Atendimento</button>
                                <input type="button" name='btn_sair' id='btn_sair' class="btn btn-default" data-dismiss="modal" value="Sair"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </body>



</html>