<?php
require_once '../funcoes/funcoes.php';


?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>SSEL 2 - Programa de Pós-Graduação em Ciência da Computação</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo site ?>/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo site ?>/includes/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo site ?>/includes/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo site ?>/includes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <?php
                        if (isset($_GET['mensagem'])) {
                            $mensagem = unserialize($_GET['mensagem']);
                            echo $mensagem;
                        }
                        ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?f=login">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="username">                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password">
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
                                    <button type="submit"class="btn btn-lg btn-success btn-block">Login</button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                        <a href="<?php echo site ?>/candidato/registro.php">
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
        <script src="<?php echo site ?>/includes/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo site ?>/includes/bootstrap/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo site ?>/includes/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo site ?>/includes/js/sb-admin-2.js"></script>
    </body>
</html>