<?php
/*
  (isset($_GET['status'])) ? $status = $_GET['status'] : $status = 'nao_finalizado';
  if ($status =='finalizado'):
  echo 'lista todos os atendimentos finalizados';
  else:
  echo 'lista todos os atendimentos  não finalizados';
  endif;
 */
?>
<style type="text/css">
    .my-bg-danger {
        background-color: red !important;
    }
    .my-bg-warning {
        background-color: red !important;
    }
</style>
<div id='total_prioridade' class="alert alert-danger">
    <b>Atenção</b>! Existem {XX} atendimentos em situação de prioridade para acessá-los clique 
    <a         
        class="alert-link"
        onclick="allAtendimentoPrioridade()" 
        id="allAtendimentoPrioridade">
        aqui
    </a>.
</div>

<h1 align="center" id='titulo_h1'>Atendimentos não finalizados</h1>

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

<div id="modal_atendimento" class="modal fade" data-backdrop="static">
    <style>
        .modal .modal-dialog { width: 850px;}                    
    </style>
    <div class="modal-dialog modal-lg">
        <form action="#" id="form_atendimento" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo Atendimento</h4>
                    <div id='info'></div>
                </div>
                <div class="modal-body">                                
                    <label id='label_interessado'>Interessado</label>                       
                    <a 
                        class="btn btn-primary btn-sm" 
                        type="button" 
                        href="#" 
                        onclick="cadastrar_interessado()" 
                        id="cadastrar_interessado">
                        <i class="fa fa-user-plus"></i>
                        Novo
                    </a>

                    <input 
                        id="interessado" 
                        name="interessado" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o intressado do atendimento">
                    <div id='lista_assunto'>assuntos</div>
                    <div id ='div_assunto'>
                        <label id='label_assunto'>Assunto</label>
                        <input 
                            onkeyup="limite(this)"
                            id="assunto" 
                            name="assunto" 
                            class="form-control txt-auto" 
                            required="true"
                            placeholder="Informe o assunto do atendimento">                              
                    </div>
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
                    <button style="float: left;" type="button" data-status='' name='status_atendimento' id="status_atendimento" class="btn btn-danger" onclick="status_atendimento()">status Atendimento</button>
                    <button type="button" data-status='' name='prioridade_atendimento' id="prioridade_atendimento" class="btn btn-info" onclick="prioridade_atendimento()">prioridade Atendimento</button>
                    <input type="button" name='btn_sair' id='btn_sair' class="btn btn-default" data-dismiss="modal" value="Sair"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_interessado" tabindex="-1" class="modal fade" data-backdrop="static" style=";z-index:10000">
    <style>
        .modal .modal-dialog { width: 850px;}                    
    </style>
    <div class="modal-dialog modal-lg">
        <form action="#" id="form_interessado" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo Interessado</h4>
                    <div id='info_interessado'></div>
                </div>
                <div class="modal-body">
                    <label id='label_interessado'>Interessado</label>                       
                    <input 

                        name="interessado"
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o nome do intressado">

                    <label id='label_matricula'>Matricula</label>                       
                    <input 
                        id="matricula" 
                        name="matricula" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe a matricula">

                    <label id='label_email'>Email</label>                       
                    <input 
                        id="email" 
                        name="email" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o email">

                    <label id='fone_residencial'>Fone Residencial</label>                       
                    <input 
                        id="fone_residencial" 
                        name="fone_residencial" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o Fone Residencial">

                    <label id='fone_celular'>Fone Celular</label>                       
                    <input 
                        id="fone_celular" 
                        name="fone_celular" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o Fone Celular">

                    <label id='label_categoria'>Categoria</label>
                    <input 
                        id="categoria" 
                        name="categoria" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe a Categoria">

                    <label id='labe_curso'>Curso</label>
                    <input 
                        id="curso" 
                        name="curso" 
                        class="form-control txt-auto" 
                        required="true"
                        placeholder="Informe o Curso">                    
                </div>

                <div class="modal-footer">
                    <button type="button" name='salvar_interessado' id="salvar_interessado" class="btn btn-success" onclick="salva_interessado()">Salvar</button>                                        
                    <input type="button" name='btn_sair' id='btn_sair' class="btn btn-default" data-dismiss="modal" value="Sair"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_prioridade" class="modal fade" data-backdrop="static">
    <style>
        .modal .modal-dialog { width: 850px;}                    
    </style>
    <div class="modal-dialog modal-lg">
        <form action="#" id="form_interessado" au tocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Atendimentos prioritários</h4>
                    <div id='info_interessado'></div>
                </div>
                <div class="modal-body">
                    <table style="width:100%;" id="atendimento_prioridade"
                           style="font-size: 10pt"
                           class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:5%;">Id</th>
                                <th style="width:60%;">Interessado</th>
                                <th style="width:25%;">Assunto</th>
                                <th style="width:10%;">Prioridade</th>  
                                <th style="width:10%;">Atendimento</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="modal-footer">                    
                    <input type="button" name='btn_sair' id='btn_sair' class="btn btn-default" data-dismiss="modal" value="Sair"/>
                </div>
            </div>
        </form>
    </div>
</div>