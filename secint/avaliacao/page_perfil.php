<?php
$perfil = "";
$acao = "";

if ($perfil == "admin") {
    echo "perfil admin";
} else {
    //echo "perfil usuario";
}

if ($acao == "add") {
    echo "acção de adicionar";
} elseif ($acao == "edit") {
    echo "ação editar";
}

$vars = [$_SESSION['id_usuario']];
$sql = "select * from usuario where id_usuario =?";
$usuario = get_data($sql, $vars);
//print_r($usuario);
//echo $usuario[0]['nome']
?>


<div class="wrapper" role="main">
    <div class="container">
              
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Página de perfil
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
            <?php
            if (isset($_GET['mensagem'])) {
                $mensagem = unserialize($_GET['mensagem']);
                echo $mensagem;
            }
            ?>
  
                <div class="row">

                    <!-- começa aqui o conteúdo de cada página -->
                        <form class="form-horizontal" id="form_perfil">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nome">Nome</label>  
                                <div class="col-md-6">
                                    <input 
                                        id="nome" 
                                        value="<?php echo $usuario[0]['nome'] ?>" 
                                        name="nome" 
                                        type="text" 
                                        placeholder="Nome Completo" 
                                        class="form-control input-md"
                                        disabled>

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Email</label>  
                                <div class="col-md-6">
                                    <input id="email" value="<?php echo $usuario[0]['email'] ?>" name="email" type="email" placeholder="Email" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="username">Username</label>  
                                <div class="col-md-6">
                                    <input 
                                        id="username" 
                                        value="<?php echo $usuario[0]['username'] ?>" 
                                        name="username" 
                                        type="text" 
                                        placeholder="Username" 
                                        class="form-control input-md"
                                        disabled>

                                </div>
                            </div>

                                                        
                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="password_new">Nova Senha</label>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="password_new" name="password_new" type="password" placeholder="nova senha" class="form-control input-md">
                                    <span class="help-block">(Informe sua nova senha)</span>
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirmpassword">Confirmar nova senha</label>
                                <div class="col-md-6">
                                    <input id="confirmpassword_new  " name="confirmpassword_new" type="password" placeholder="senha" class="form-control input-md">
                                    <span class="help-block">(Confirme sua nova senha)</span>
                                </div>
                            </div>

                            <!-- Multiple Radios -->
                          

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Cadastrar"></label>
                                <div class="col-md-8">
                                    <button id="salvar_perfil" name="salvar_perfil" class="btn btn-success">Salvar</button>
                                    <button id="cancelar_perfil" name="cancelar" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <!-- termina aqui o conteúdo de cada página-->    
                </div>
            </div>
        </div>
        <!-- /.panel -->
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>