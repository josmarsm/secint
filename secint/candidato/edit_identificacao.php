<?php

$var_selected = [$_SESSION['id_usuario']];
$sql_selected = "select * from identificacao where id_usuario=?";
$selected = get_data($sql_selected, $var_selected);
$linha_selected1 = $selected[0]['linha_pesquisa_1'];
$linha_selected2 = $selected[0]['linha_pesquisa_2'];
$orientador_selected1 = $selected[0]['orientador_1'];
$orientador_selected2 = $selected[0]['orientador_2'];
$orientador_selected3 = $selected[0]['orientador_3'];
$poscomp_checked = utf8_encode($selected[0]['poscomp']);
$ano_poscomp = $selected[0]['ano_poscomp'];
$nota_poscomp = $selected[0]['nota_poscomp'];
$bolsa_ckecked = utf8_encode($selected[0]['bolsa']);
?>

<div class="modal fade" id="myedit"  role="dialog" >

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo 'Edição do Formulário de Identificação [<b> ' . $_SESSION['nome']; ?> </b>]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-inline"
                      role="form" 
                      method="post" 
                      action='<?php echo site . '/candidato/?p=identificacao&f=add_identificacao&id=' . $_SESSION['id_usuario']; ?>'>

                    <!-- Select Basic -->
                    <div class="form-group">

                        <label class="col-md-4 control-label" for="linha_pesquisa_1">Linha de Pesquisa 1 <h11>*</h11></label>                                
                        <div class="col-md-6">
                            <select required id="linha_pesquisa_1" name="linha_pesquisa_1" class="form-control">
                                <?php
                                $sql_linha1 = "select * from linha_pesquisa";
                                $linha1 = get_data($sql_linha1, $vars);
                                ?>
                                <option value=""></option>
                                <?php
                                foreach ($linha1 as $col1) {

                                    if ($col1['id_linha_pesquisa'] == $linha_selected1) {
                                        echo '<option selected value =' . $col1['id_linha_pesquisa'] . '>' . $col1['linha_pesquisa'] . '</option>';
                                    } else {
                                        echo '<option value =' . $col1['id_linha_pesquisa'] . '>' . $col1['linha_pesquisa'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class = "form-group">
                        <!--Select Basic -->

                        <label class = "col-md-4 control-label" for = "linha_pesquisa_2">Linha de Pesquisa 2 <h11>*</h11></label>
                        <div class = "col-md-6">
                            <select required id = "linha_pesquisa_2" name = "linha_pesquisa_2" class = "form-control">
                                <?php
                                $sql_linha2 = "select * from linha_pesquisa";
                                $linha2 = get_data($sql_linha2, $vars);
                                ?>
                                <option value=""></option>
                                <?php
                                foreach ($linha2 as $col2) {

                                    if ($col2['id_linha_pesquisa'] == $linha_selected2) {
                                        echo '<option selected value =' . $col2['id_linha_pesquisa'] . '>' . $col2['linha_pesquisa'] . '</option>';
                                    } else {
                                        echo '<option value =' . $col2['id_linha_pesquisa'] . '>' . $col2['linha_pesquisa'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">

                        <label class="col-md-4 control-label" for="orientador_1">Orientador 1 <h11>*</h11></label>

                        <div class="col-md-6">
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
                                    if ($col['id_orientador'] == $orientador_selected1) {
                                        echo '<option selected value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    } else {
                                        echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="orientador_2">Orientador 2 <h11>*</h11></label>

                        <div class="col-md-6">
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
                                    if ($col['id_orientador'] == $orientador_selected2) {
                                        echo '<option selected value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    } else {
                                        echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Select Basic -->

                        <label class="col-md-4 control-label" for="orientador_3">Orientador 3 <h11>*</h11></label>

                        <div class="col-md-6">
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
                                    if ($col['id_orientador'] == $orientador_selected3) {
                                        echo '<option selected value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    } else {
                                        echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Multiple Radios (inline) -->
                        <label class="col-md-4 control-label" for="poscomp">Utilizar POSCOMP? <h11>*</h11></label>

                        <div class="col-md-4"> 
                            <label class="radio-inline" for="poscomp-0" >
                                <input 
                                <?php
                                if ($poscomp_checked == 'Sim') {
                                    echo "checked";
                                }
                                ?>
                                    type="radio" name="poscomp" id="poscomp_sim" value="Sim" required>
                                Sim
                            </label> 
                            <label class="radio-inline" for="poscomp-1">
                                <input 
                                <?php
                                if ($poscomp_checked == 'Não') {
                                    echo "checked";
                                }
                                ?>
                                    type = "radio" name = "poscomp" id = "poscomp_nao" value = "Nao">
                                Não
                            </label>
                        </div>

                        <div class="form-group row" id="poscomp_complemento" <?php
                                if ($poscomp_checked == 'Sim') {
                                    echo "";
                                }else {
                                    echo 'hidden disable';
                                }
                                ?>>
                            <div class = "col-xs-2">
                                <label for = "ano_poscomp">Ano:</label>
                                <input type = "text" class = "form-control" name = "ano_poscomp">
                            </div>

                            <div class = "col-xs-2">
                                <label for = "nota_poscomp">Nota:</label>
                                <input type = "text" class = "form-control" name = "nota_poscomp">
                            </div>
                        </div>

                    </div>

                    <div class = "form-group">
                        <!--Multiple Radios (inline) -->
                        <label class = "col-md-4 control-label" for = "bolsa">Bolsa? <h11>*</h11></label>

                        <div class = "col-md-6">
                            <label class = "radio-inline" for = "bolsa-0" >
                                <input type = "radio" name = "bolsa" id = "bolsa_sim" value = "Sim" required>
                                Sim
                            </label>
                            <label class = "radio-inline" for = "bolsa-1">
                                <input type = "radio" name = "bolsa" id = "bolsa_nao" value = "Não" >
                                Não
                            </label>
                        </div>
                    </div>

            </div>
            <div class = "modal-footer">
                <button id = "Salvar" name = "Salvar" class = "btn btn-success" type = "Submit">Salvar</button>
                <button id = "Cancelar" name = "Cancelar" class = "btn btn-danger" data-dismiss = "modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>


</div>