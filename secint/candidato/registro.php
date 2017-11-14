<?php
require_once '../funcoes/funcoes.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SSEL 2 - Programa de Pós-Graduação em Ciência da Computação</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo site ?>/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo site ?>/includes/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo site ?>/includes/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo site ?>/includes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">    
           
            <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Sign Up</div>
                        <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo site ?>/candidato/?p=login">Sign In</a></div>
                    </div>  
                    <div class="panel-body" >
                        <form id="signupform" 
                              class="form-horizontal" 
                              role="form" 
                              method="post" 
                              action="<?php echo site .'/candidato/registro.php?f=signup';?>">
<?php
echo $mensagem
        ?>
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>

                            <div class="form-group">
                                <label for="fullname" class="col-md-3 control-label">Full Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" value="<?php echo $_POST['fullname']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $_POST['email']; ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="add_username" class="col-md-3 control-label">Usernme</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="add_username" placeholder="Username" value="<?php echo $_POST['add_username']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-3 control-label">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="add_password" placeholder="Password" value="<?php echo $_POST['add_password']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="re_password" class="col-md-3 control-label">Re-Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="re_password" placeholder="Re-Password" value="<?php echo $_POST['re_password']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Button -->                                        
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" id="btn-signup" type="button" class="btn btn-info">
                                        <i class="icon-hand-right"></i> &nbsp Sign Up</button>
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