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
                    Candidatos para avaliação da prova e entrevista
                </div>
                <div class="panel-body">   
                    <div class="table-responsive">
                        <table id="candidato_data_orientador" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%; text-align:center;">Inscrição</th>
                                    <th style="width:35%; text-align:center;">Nome</th>
                                    <th style="width:14%; text-align:center;">Nota Curriculo</th>
                                    <th style="width:10%; text-align:center;">Nota Prova</th>
                                    <th style="width:13%; text-align:center;">Nota Entrevista</th>
                                    <th style="width:12%; text-align:center;">Nota Final</th>
                                    <th style="width:5%; text-align:center;">Status</th>
                                    <th style="width:10%; text-align:center;">Situação</th>
                                    <th style="width:5%; text-align:center;">Delegar</th>
                                </tr>
                            </thead>
                        </table>   
                    </div>                   
                </div>                
            </div>
        </div>
    </div>
</div>

<div id="candidatoModal_orientador" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form method="post" id="candidato_form_orientador" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Linha de Pesquisa 1</label>                                
                            <input type="text" class="form-control" name="linha_pesquisa_1" id="linha_pesquisa_1" readonly>                            
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Linha de Pesquisa 2</label>
                            <input type="text" class="form-control" name="linha_pesquisa_2" id="linha_pesquisa_2" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Orientador 1</label>
                            <input type="text" class="form-control" name="orientador_1" id="orientador_1" readonly>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label>Orientador 2</label>
                            <input type="text" class="form-control" name="orientador_2" id="orientador_2" readonly>
                        </div>
                        <div class="col-xs-6 form-group">                            
                            <label>Orientador 3</label>
                            <input type="text" class="form-control" name="orientador_3" id="orientador_3" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 form-group">                            
                            <label for="poscomp">Utilizar POSCOMP? <h11>*</h11></label>
                            <input type="text" class="form-control" name="poscomp" id="poscomp" readonly>
                        </div>
                        <div class="col-xs-6 form-group">
                            <label for="bolsa">Bolsa? <h11>*</h11></label>
                            <input type="text" class="form-control" name="bolsa" id="bolsa" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group"> 
                            <label class="radio-inline"style="color:red">Nota Fase 1 [Curriculo]
                                <input width="5px" type="text" name="nota_curriculo" id="nota_curriculo" class="form-control" readonly/>                            
                            </label>
                        </div>
                        <div class="col-xs-4 form-group"> 
                            <label class="radio-inline"style="color:red">Nota Prova Escrita
                                <input width="5px" type="text" name="nota_prova" id="nota_prova" class="form-control"/>                            
                            </label>
                        </div>
                        <div class="col-xs-4 form-group"> 
                            <label class="radio-inline"style="color:red">Nota Entrevista
                                <input width="5px" type="text" name="nota_entrevista" id="nota_entrevista" class="form-control"/>                            
                            </label>
                        </div>
                    </div>
                        <div class="form-group">
                        <div class="chat-panel panel panel-default">

                            <div class="panel-heading">
                                <i class="fa fa-comments fa-fw"></i> Observações                          
                            </div>
                            <div class="panel-body">
                                <div id="observacao"></div>                                                                   
                            </div>
                            <!-- /.panel-body -->

                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="textoObservacao" type="text" class="form-control input-sm" placeholder="Escreva uma nova observação..." >
                                    
                                    <span class="input-group-btn">
                                        
                                        <a class="btn btn-warning btn-sm" type="button" href="#" onClick="salva_observacao()" id="salva_observacao">Salva Observação</a>
                                    </span>
                                </div>
                            </div>

                            <!-- /.panel-footer -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_candidato" id="id_candidato" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="button" onclick='salva_candidato_orientador();' name="salva_avaliacao" id="salva_avaliacao " class="btn btn-success" value="Salvar Avaliação" />                        
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