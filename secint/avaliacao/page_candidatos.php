<?php
//include '../funcoes/config.php';
global $db;

//$parametro_identificacao = 1;
$sql_identificacao = 'SELECT i.*, u.*
FROM identificacao AS i
INNER JOIN usuario AS u ON i.id_usuario = u.id_usuario';
$result_identificacao = $db->prepare($sql_identificacao);
//$result_identificacao->bindParam(':parametro_identificacao', $parametro_identificacao);
$result_identificacao->execute();
$count = $result_identificacao->rowCount();
$candidatos = $result_identificacao->fetchAll();
//print_r($candidatos);
?>
<div class="row setup-content" id="step-1">
    <div class="col-xs-12">
        <div class="col-md-12 well text-center">
            <h1> Candidatos</h1>

            <form>                
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <a id="add_row" class="btn btn-success pull-left">Add Candidato</a><a id='delete_row' class="btn btn-danger pull-right">Delete Candidato</a>
                            <br /><br /><br />

                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                    <tr >
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            Nome
                                        </th>
                                        <th class="text-center">
                                            Linha
                                        </th>
                                        <th class="text-center">
                                            Avaliador
                                        </th>
                                        <th class="text-center">                             
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($candidatos as $candidato) {
                                        //echo 'Nome: '.$candidato['nome'];
                                        ?>

                                        <tr id="row<?php echo $row['id']; ?>">
                                            <td id="name_val<?php echo $candidato['nome']; ?>"><?php echo $candidato['nome']; ?></td>
                                            <td id="age_val<?php echo $candidato['nome']; ?>"><?php echo $candidato['nome']; ?></td>
                                            <td id="age_val<?php echo $candidato['nome']; ?>"><?php echo $candidato['nome']; ?></td>
                                            <td id="age_val<?php echo $candidato['nome']; ?>"><?php echo $candidato['nome']; ?></td>
                                            
                                            <td>
                                                <input type='button' class="edit_button" id="edit_button<?php echo $candidato['id_usuario']; ?>" value="edit" onclick="edit_row('<?php echo $candidato['id_usuario']; ?>');">
                                                <input type='button' class="save_button" id="save_button<?php echo $candidato['id_usuario']; ?>" value="save" onclick="save_row('<?php echo $candidato['id_usuario']; ?>');">
                                                <input type='button' class="delete_button" id="delete_button<?php echo $candidato['id_usuario']; ?>" value="delete" onclick="delete_row('<?php echo $candidato['id_usuario']; ?>');">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr id='addr0'>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <input type="text" name='name0'  placeholder='Nome' class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name='linha0' placeholder='Linha' class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name='avaliador0' placeholder='Avaliador' class="form-control"/>
                                        </td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                </div>
            </form>
        </div>
    </div>
</div>