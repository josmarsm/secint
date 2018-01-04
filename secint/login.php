<?php
//require_once '../funcoes/funcoes.php';
include './funcoes/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Sec Int 1.0 - Sistema de Controle de Atendimentos</title>
        <!-- Bootstrap Core CSS -->

        <link rel="stylesheet" href="media/css/bootstrap.min.css">
        <link rel="stylesheet" href="media/css/bootstrap-theme.min.css">
        <script src="media/js/jquery-1.10.2.js"></script>
        <script src="media/js/bootstrap.min.js"></script>        
        <script src="<?php echo SITE ?>/media/js/atendimento.js"></script>

    </head>
    <body>
        <div class="container">    
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <div id="resultado"></div>
                        <form id='form_login'>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="username" id="username">                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>

                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                    </label>
                                </div>
                            </div>


                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                    <!-- Change this to a button or input when using this as a form -->                                    
                                    <button type="button" name='login' id="login" class="btn btn-lg btn-success btn-block" onclick="goLogin()">Login</button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                        <a href="<?php echo SITE ?>/candidato/registro.php">
                                            Sign Up Here
                                        </a>
                                    </div>
                                </div>
                            </div>    
                        </form>     



                    </div>                     
                </div>  
            </div>

        </div>

        <!-- jQuery -->

    </body>
</html>