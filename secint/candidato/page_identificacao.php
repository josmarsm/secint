<?php
verifica();

$perfil = [$_SESSION['perfil']];
$vars = [$_SESSION['id_usuario']];


$sql_identificacao = "select * from identificacao where id_usuario =?";
$identificacao = get_data($sql_identificacao, $vars);

$sql_usuario = "select * from usuario where id_usuario =?";
$usuario = get_data($sql_usuario, $vars);

if (count($identificacao) > 0) {
    $acao = 'view_identificacao';
} else {
    $acao = 'add_identificacao';
}



if (isset($_GET['f'])) {
    //echo 'exite a variavel via get e seta o valor';
    //echo $_GET['f'];
    $acao = $_GET['f'];
} else {
    //echo 'não existe a variavel seta o valor da acao';
    //echo $acao;
}
?>
<div class="container">
    <div>
    </div>
    <?php
    if ($acao == 'view_identificacao') {
        $titulo_acao = 'Visualização do ';
        ?>
        <!-- /.row -->
        <div class="row">
            <!-- começa aqui o conteúdo de cada página -->
            <form class="form-horizontal" role="form" method="post" action="<?php echo site . '/candidato/?p=identificacao&f=edit_identificacao&id=' . $_SESSION['id_usuario']; ?>">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php
                            $id_aplicacao = 1;
                            echo $titulo_acao.'Formulário de Identificação [<b> ' . $_SESSION['nome'] . '</b> ]';
                            $aplicacao = 'Edição de Identificação';
                            $status_aplicacao = status_aplicacao($id_aplicacao);

                            if ($status_aplicacao[0] == 'ativada') {
                                echo ' <button type="button" id="Editar" name="Editar" class="btn btn-success" data-toggle="modal" data-target="#myedit">Editar</button>';
                            } else {
                                echo utf8_encode($status_aplicacao[1]) . '<br>';
                            }
                            ?>

                        </div>

                        <!-- Modal -->
                        <?php
                        include 'edit_identificacao.php';
                        ?>

                        <div class="panel-body">
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="linha_pesquisa_1">Linha de Pesquisa 1:</label>
                                <div class="col-md-3">
                                    <label >
                                        <?php
                                        $vars = [$identificacao[0]['linha_pesquisa_1']];
                                        $sql_linha1 = "select * from linha_pesquisa where id_linha_pesquisa=?";
                                        $linha1 = get_data($sql_linha1, $vars);
                                        echo utf8_encode($linha1[0]['linha_pesquisa']);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <div class = "form-group">
                                <!--Select Basic -->
                                <label class = "col-md-2 control-label" for = "linha_pesquisa_2">Linha de Pesquisa 2:</label>                                
                                <div class = "col-md-3">
                                    <label>
                                        <?php
                                        $vars = [$identificacao[0]['linha_pesquisa_2']];
                                        $sql_linha2 = "select * from linha_pesquisa where id_linha_pesquisa=?";
                                        $linha2 = get_data($sql_linha2, $vars);
                                        echo utf8_encode($linha2[0]['linha_pesquisa']);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="orientador_1">Orientador 1:</label>                                
                                <div class="col-md-3">
                                    <label>
                                        <?php
                                        $vars = [$identificacao[0]['orientador_1']];
                                        $sql_orientador1 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=?";
                                        $orientador1 = get_data($sql_orientador1, $vars);
                                        echo utf8_encode($orientador1[0]['nome']);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="orientador_2">Orientador 2:</label>                                
                                <div class="col-md-3">
                                    <label>
                                        <?php
                                        $vars = [$identificacao[0]['orientador_2']];
                                        $sql_orientador2 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=?";
                                        $orientador2 = get_data($sql_orientador2, $vars);
                                        echo utf8_encode($orientador2[0]['nome']);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Select Basic -->
                                <label class="col-md-2 control-label" for="orientador_3">Orientador 3:</label>                                
                                <div class="col-md-3">
                                    <label>
                                        <?php
                                        $vars = [$identificacao[0]['orientador_3']];
                                        $sql_orientador3 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=?";
                                        $orientador3 = get_data($sql_orientador3, $vars);
                                        echo utf8_encode($orientador3[0]['nome']);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Multiple Radios (inline) -->
                                <label class="col-md-2 control-label" for="poscomp">Utilizar POSCOMP? <h11>*</h11></label>
                                <div class="col-md-3"> 
                                    <label>
                                        <?php
                                        if ($identificacao[0]['poscomp'] == 'Sim') {
                                            echo utf8_encode($identificacao[0]['poscomp']);
                                            echo ' [' . $identificacao[0]['ano_poscomp'] . ' - ' . $identificacao[0]['nota_poscomp'] . ' pontos]';
                                        } else {
                                            echo utf8_encode($identificacao[0]['poscomp']);
                                        }
                                        ?>
                                    </label>                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Multiple Radios (inline) -->
                                <label class="col-md-2 control-label" for="bolsa">Bolsa? <h11>*</h11></label>
                                <div class="col-md-3"> 
                                    <label >
                                        <?php echo utf8_encode($identificacao[0]['bolsa']); ?>
                                    </label>                                        
                                </div>
                            </div>                            

                        </div>
                    </div>
                </fieldset>
            </form>

            <!-- termina aqui o conteúdo de cada página-->    



            <!-- /.panel -->
            <!-- /.col-lg-12 -->
        </div>
        <?php
    }
    if ($acao == 'add_identificacao') {
        $titulo_acao = 'Adição do ';
        ?>
        <div class="row">
            <!-- começa aqui o conteúdo de cada página -->
            <form class="form-horizontal" role="form" method="post" action="<?php echo site . '/candidato/?p=identificacao&f=add_identificacao&id=' . $_SESSION['id_usuario']; ?>">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><?php echo $titulo_acao . 'Formulário de Identificação [<b> ' . $_SESSION['nome']; ?> </b>]</div>
                        <div class="panel-body">                                               

                            <!-- Select Basic -->
                            <div class="form-group">

                                <label class="col-md-2 control-label" for="linha_pesquisa_1">Linha de Pesquisa 1 <h11>*</h11></label>                                
                                <div class="col-md-3">
                                    <select required id="linha_pesquisa_1" name="linha_pesquisa_1" class="form-control">
                                        <?php
                                        $sql_linha1 = "select * from linha_pesquisa";
                                        $linha1 = get_data($sql_linha1, $vars);
                                        ?>
                                        <option value=""></option>
                                        <?php
                                        foreach ($linha1 as $col) {
                                            echo '<option value =' . $col['id_linha_pesquisa'] . '>' . utf8_encode($col['linha_pesquisa']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class = "form-group">
                                <!--Select Basic -->

                                <label class = "col-md-2 control-label" for = "linha_pesquisa_2">Linha de Pesquisa 2 <h11>*</h11></label>
                                <div class = "col-md-3">
                                    <select required id = "linha_pesquisa_2" name = "linha_pesquisa_2" class = "form-control">
                                        <?php
                                        $sql_linha2 = "select * from linha_pesquisa";
                                        $linha1 = 3;
                                        $vars = [$linha1];
                                        $linha2 = get_data($sql_linha2, $vars);
                                        ?>
                                        <option value=""></option>
                                        <?php
                                        foreach ($linha2 as $col) {
                                            echo '<option value =' . $col['id_linha_pesquisa'] . '>' . utf8_encode($col['linha_pesquisa']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">

                                <label class="col-md-2 control-label" for="orientador_1">Orientador 1 <h11>*</h11></label>

                                <div class="col-md-3">
                                    <select required id="orientador_1" name="orientador_1" class="form-control">
                                        <?php
                                        $sql_orientador1 = "SELECT orientador.id_orientador,
                                        usuario.nome, linha_pesquisa.linha_pesquisa, 
                                        linha_pesquisa.sigla
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario
                                        INNER JOIN linha_pesquisa
                                        ON orientador.id_linha_pesquisa = linha_pesquisa.id_linha_pesquisa";
                                        $orientador1 = get_data($sql_orientador1, $vars);
                                        ?>
                                        <option value=""></option>

                                        <?php
                                        foreach ($orientador1 as $col) {
                                            echo '<option value =' . $col['id_orientador'] . '>' . utf8_encode($col['nome']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="orientador_2">Orientador 2 <h11>*</h11></label>

                                <div class="col-md-3">
                                    <select required id="orientador_2" name="orientador_2" class="form-control">
                                        <?php
                                        $sql_orientador2 = "SELECT orientador.id_orientador,
                                        usuario.nome, linha_pesquisa.linha_pesquisa, 
                                        linha_pesquisa.sigla
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario
                                        INNER JOIN linha_pesquisa
                                        ON orientador.id_linha_pesquisa = linha_pesquisa.id_linha_pesquisa";
                                        $orientador2 = get_data($sql_orientador2, $vars);
                                        ?>
                                        <option value=""></option>
                                        <?php
                                        foreach ($orientador2 as $col) {
                                            echo '<option value =' . $col['id_orientador'] . '>' . utf8_encode($col['nome']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Select Basic -->

                                <label class="col-md-2 control-label" for="orientador_3">Orientador 3 <h11>*</h11></label>

                                <div class="col-md-3">
                                    <select required id="orientador_3" name="orientador_3" class="form-control">
                                        <?php
                                        $sql_orientador2 = "SELECT orientador.id_orientador,
                                        usuario.nome, linha_pesquisa.linha_pesquisa, 
                                        linha_pesquisa.sigla
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario
                                        INNER JOIN linha_pesquisa
                                        ON orientador.id_linha_pesquisa = linha_pesquisa.id_linha_pesquisa";
                                        $orientador2 = get_data($sql_orientador2, $vars);
                                        ?>
                                        <option value=""></option>
                                        <?php
                                        foreach ($orientador2 as $col) {
                                            echo '<option value =' . $col['id_orientador'] . '>' . utf8_encode($col['nome']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Multiple Radios (inline) -->
                                <label class="col-md-2 control-label" for="poscomp">Utilizar POSCOMP? <h11>*</h11></label>

                                <div class="col-md-3"> 
                                    <label class="radio-inline" for="poscomp-0" >
                                        <input type="radio" name="poscomp" id="poscomp_sim" value="Sim" required>
                                        Sim
                                    </label> 
                                    <label class="radio-inline" for="poscomp-1">
                                        <input type="radio" name="poscomp" id="poscomp_nao" value="Nao">
                                        Nao
                                    </label>
                                </div>

                                <div class="form-group row" id="poscomp_complemento" hidden disable>
                                    <div class="col-xs-2">
                                        <label for="ano_poscomp">Ano:</label>
                                        <input type="text" class="form-control" name="ano_poscomp">
                                    </div>                            

                                    <div class="col-xs-2">
                                        <label for="nota_poscomp">Nota:</label>
                                        <input type="text" class="form-control" name="nota_poscomp">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <!-- Multiple Radios (inline) -->
                                <label class="col-md-2 control-label" for="bolsa">Bolsa? <h11>*</h11></label>

                                <div class="col-md-4"> 
                                    <label  class="radio-inline" for="bolsa-0" >
                                        <input type="radio" name="bolsa" id="bolsa_sim" value="Sim" required>
                                        Sim
                                    </label> 
                                    <label class="radio-inline" for="bolsa-1">
                                        <input type="radio" name="bolsa" id="bolsa_nao" value="Não" >
                                        Não
                                    </label>
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Cadastrar"></label>
                                <div class="col-md-8">
                                    <button id="Cadastrar" name="Cadastrar" class="btn btn-success" type="Submit" onclick="waitingDialog.show('Informações sendo processadas');
                                            setTimeout(function () {
                                                waitingDialog.hide();
                                            }, 4000);">Cadastrar</button>
                                    <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </fieldset>
            </form>

            <!-- termina aqui o conteúdo de cada página-->    



            <!-- /.panel -->
            <!-- /.col-lg-12 -->
        </div>        
        <?php
    }
    ?>


    <!-- /.row -->
</div>