<?php
$sql_linha = "select * from linha_pesquisa";
$sql_orientador = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario";
?>

</script> 
<div class="wrapper" role="main">
    <div class="container">

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Candidatos para avaliação do curriculo
                </div>
                <div class="panel-body">   
                    <div class="table-responsive">
                        <table id="candidato_data_comissao" class="table table-bordered table-striped">
                            <thead>
                                <p style="align-content: center;">
                                <tr>
                                    <th style="width:20px; text-align:left;">Inscrição</th>
                                    <th style="width:200px; text-align:left;">Nome</th>
                                    <th style="width:20px; text-align:center;">Inscricao|Documentacao</th>
                                    <th style="width:20px; text-align:center;">Nota Curriculo</th>
                                    <th style="width:20px; text-align:center;">Status</th>
                                    <th style="width:68px; text-align:center;">Situação</th>
                                    <th style="width:20px; text-align:center;">Delegar</th>
                                    <th style="width:20px; text-align:center;">Fichas</th>                            
                                </tr>
                            </thead>
                        </table>   
                    </div>                   
                </div>                
            </div>
        </div>
    </div>
</div>

<div id="candidatoModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form method="post" id="candidato_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Linha de Pesquisa 1</label>                                
                            <select required id="linha_pesquisa_1" name="linha_pesquisa_1" class="form-control">
                                <?php
                                global $db;
                                $statement_linha1 = $db->prepare($sql_linha);
                                $statement_linha1->execute();
                                $linha1 = $statement_linha1->fetchAll();
                                ?>
                                <option value="1">Não Informado</option>
                                <?php
                                foreach ($linha1 as $col) {
                                    echo '<option value =' . $col['id_linha_pesquisa'] . '>' . $col['linha_pesquisa'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Linha de Pesquisa 2</label>
                            <select required id = "linha_pesquisa_2" name = "linha_pesquisa_2" class = "form-control">
                                <?php
                                $statement_linha2 = $db->prepare($sql_linha);
                                $statement_linha2->execute();
                                $linha2 = $statement_linha2->fetchAll();
                                ?>
                                <option value="1">Não Informado</option>
                                <?php
                                foreach ($linha2 as $col) {
                                    echo '<option value =' . $col['id_linha_pesquisa'] . '>' . $col['linha_pesquisa'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Orientador 1</label>
                            <select required id="orientador_1" name="orientador_1" class="form-control">
                                <?php
                                $statement_orientador1 = $db->prepare($sql_orientador);
                                $statement_orientador1->execute();
                                $orientador1 = $statement_orientador1->fetchAll();
                                ?>
                                <option value="35">Não informado</option>

                                <?php
                                foreach ($orientador1 as $col) {
                                    echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Orientador 2</label>
                            <select id="orientador_2" name="orientador_2" class="form-control">
                                <?php
                                $statement_orientador2 = $db->prepare($sql_orientador);
                                $statement_orientador2->execute();
                                $orientador2 = $statement_orientador2->fetchAll();
                                ?>
                                <option value="35">Não informado</option>
                                <?php
                                foreach ($orientador2 as $col) {
                                    echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6 form-group">                            
                            <label>Orientador 3</label>
                            <select id="orientador_3" name="orientador_3" class="form-control">
                                <?php
                                $statement_orientador3 = $db->prepare($sql_orientador);
                                $statement_orientador3->execute();
                                $orientador3 = $statement_orientador3->fetchAll();
                                ?>
                                <option value="35">Não informado</option>
                                <?php
                                foreach ($orientador3 as $col) {
                                    echo '<option value =' . $col['id_orientador'] . '>' . $col['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">                            
                        <label for="poscomp">Utilizar POSCOMP? <h11>*</h11></label>
                        <label class="radio-inline" for="poscomp-0" >
                            <!--input type="radio" name="poscomp" id="poscomp_sim" value="Sim" required-->
                            <input type="radio" name="poscomp" id="poscomp_sim" value="Sim">
                            Sim
                        </label> 
                        <label class="radio-inline" for="poscomp-1">
                            <!--input type="radio" name="poscomp" id="poscomp_nao" value="Nao"-->
                            <input type="radio" name="poscomp" id="poscomp_nao" value="Nao">
                            Nao
                        </label>

                        <div class="form-group row" id="poscomp_complemento" hidden disable>
                            <div class="col-xs-2">
                                <label for="ano_poscomp">Ano da Prova:</label>
                                <input type="text" class="form-control" name="ano_poscomp" id="ano_poscomp">
                            </div>                            

                            <div class="col-xs-2">
                                <label for="nota_poscomp">Nota Poscomp:</label>
                                <input type="text" class="form-control" name="nota_poscomp" id="nota_poscomp">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bolsa">Bolsa? <h11>*</h11></label>
                        <label  class="radio-inline" for="bolsa-0" >
                            <input type="radio" name="bolsa" id="bolsa_sim" value="Sim" required>
                            Sim
                        </label> 
                        <label class="radio-inline" for="bolsa-1">
                            <input type="radio" name="bolsa" id="bolsa_nao" value="Não" >
                            Não
                        </label>
                        <label class="radio-inline"style="color:red">Nota Fase 1 [Curriculo]
                            <input width="5px" type="text" name="nota_curriculo" id="nota_curriculo" class="form-control"/>                            
                        </label>
                    </div>
                    <div class="form-group">
                        Observaçoes
                    </div>
                    
                    <div class="modal-footer">
                        <input type="hidden" name="id_identificacao" id="id_identificacao" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Salvar Avaliação" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalAvaliar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Avaliação do candidato [xxxx]</h4>
            </div>
            <div class="container">
                <div class="modal-body">

                    <div class="modal fade" id="identificacao_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="identificacao_add" aria-label="Close"><span aria-hidden="true">×
                                        </span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    identificacao_edit.php
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default hidden new" data-dismiss="modal">Novo botão</button>
                                    <button type="button" class="btn btn-default" data-dismiss="identificacao_add">Close</button>
                                    <button type="button" class="btn btn-primary close-changes">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="identificacao_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button onclick="fechaModal('identificacao_edit')" type="button" class="close" data-dismiss="identificacao_edit" aria-label="Close"><span aria-hidden="true">×
                                        </span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Edição do formulário de identificação</h4>
                                </div>
                                <div class="modal-body">
                                    identificacao_edit.php
                                    <p id="demo">Click the button to change the text in this paragraph.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default hidden new" data-dismiss="modal">Novo botão</button>
                                    <button onclick="fechaModal('identificacao_edit')" id="identificacao_edit">
                                        Try it
                                    </button>
                                    <button type="button" class="btn btn-primary close-changes">Save changes</button>
                                </div>
                            </div>
                        </div>

                    </div>            
                </div>
            </div>

            <p id="linha_pesquisa_1" name="linha_pesquisa_1">teste  </p>
            <label>Linha pesquisa 1</label>
            <input type="text" name="linha_pesquisa_1" id="linha_pesquisa_1" class="form-control" />

            <div class="view_identificacao">editar a identificação.
                <a data-toggle="modal" href="#modalIdentificacaoEdit" class="btn btn-primary">Editar</a>
            </div>

            <div class="modal-body">editar documentos.
                <a data-toggle="modal" href="#modalDocumentosEdit" class="btn btn-primary">Editar</a>
            </div>

            <div class="modal-body">deletar documentos.
                <a data-toggle="modal" href="#modalDocumentosDelete" class="btn btn-primary">Delete</a>
            </div>

            <div class="modal-body">add documentos.
                <a data-toggle="modal" href="#modalDocumentosAdd" class="btn btn-primary">Add</a>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
                <a href="#" class="btn btn-primary">Finalizar Avaliação</a>
                <input type="hidden" id="hidden_candidato_id">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelegar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delegar a avaliação do candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
                <a href="#" class="btn btn-primary">Delegar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Upload de documentos para o candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-body">editar documentos.
                <a data-toggle="modal" href="#modalDocumentosEdit" class="btn btn-primary">Editar</a>
            </div>

            <div class="modal-body">deletar documentos.
                <a data-toggle="modal" href="#modalDocumentosDelete" class="btn btn-primary">Delete</a>
            </div>

            <div class="modal-body">add documentos.
                <a data-toggle="modal" href="#modalDocumentosAdd" class="btn btn-primary">Add</a>
            </div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalIdentificacaoEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edição da identidade do candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDocumentosAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Adição de documento do candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDocumentosEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edição de documento do candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDocumentosDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Exclusão de documento do candidato [xxxx]</h4>
            </div>
            <div class="container"></div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>