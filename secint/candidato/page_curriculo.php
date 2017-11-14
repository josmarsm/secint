<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$vars = [$id];
//var_dump($vars);
$sql_identificacao = "SELECT * FROM identificacao WHERE id_usuario =?";
$identificacao = get_data($sql_identificacao, $vars);
//var_dump($identificacao);
$sql_criterio = "SELECT * FROM criterio WHERE id_criterio =?";
$sql_subcriterio = "SELECT * FROM subcriterio WHERE id_subcriterio =?";
$sql_documento = "SELECT *
FROM `documento`
INNER JOIN subcriterio on documento.id_subcriterio = subcriterio.id_subcriterio
INNER JOIN criterio on subcriterio.id_criterio = criterio.id_criterio
where id_usuario = ? and criterio.id_criterio=?";
?>
<html>
    <head>     
        <script src="<?php echo site ?>/includes/selecao/crud_upload.js"></script>

    </head>  
    <body>  
        <div class="container">

            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php
                        $id_aplicacao = 2;
                        echo 'Formulário de Upload de Documentos [<b> ' . $_SESSION['nome'] . '</b> ]';
                        $status_aplicacao = status_aplicacao($id_aplicacao);
                        if ($status_aplicacao[0] == 'ativada') {
                            echo ' Edição Ativa';
                        } else {
                            echo utf8_encode($status_aplicacao[1]) . '<br>';
                        }
                        ?>
                    </div>

                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a 
                                            href="#step1" 
                                            data-toggle="tab" 
                                            aria-controls="step1" 
                                            role="tab" 
                                            title="Formação Acadêmica"
                                            data-criterio="1"
                                            data-usuario="<?php echo $_SESSION["id_usuario"];?>"
                                            onclick="Ativa_Tela('1','1')">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-education"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a 
                                            href="#step2" 
                                            data-toggle="tab" 
                                            aria-controls="step2" 
                                            role="tab" 
                                            title="Atividades Profissionais e Participação em eventos">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-wrench"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a 
                                            href="#step3" 
                                            data-toggle="tab" 
                                            aria-controls="step3" 
                                            role="tab" 
                                            title="Publicação">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-picture"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a 
                                            href="#complete" 
                                            data-toggle="tab" 
                                            aria-controls="complete" 
                                            role="tab" title="Complete">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <form id='tabpanel' role="form" >
                                <p id="msg"></p>
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="panel panel-default panel-table">
                                                <div class="panel-heading">
                                                    <div class="row">

                                                        <div class="col col-xs-6">
                                                            <h3 class="panel-title">Formação Acadêmica (máximo 4,0 pontos)</h3> 
                                                            <p id="total_pontuacao">Pontuação:</p>                                                            
                                                        </div>

                                                        <div class="col col-xs-6 text-right">
                                                            <div class="pull-right">
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <button type="button" class="btn btn-primary next-step">Save and continue</button>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="panel-body">
                                                    <div class="pull-left">   
                                                        <button
                                                            onclick="GetCriterio('1')"
                                                            type="button" 
                                                            titulo="Formação Acadêmica" 
                                                            data-criterio="1" 
                                                            data-toggle="modal" 

                                                            class="btn btn-sm btn-primary btn-create">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                            Upload
                                                        </button>                                                                            
                                                    </div>
                                                    <table id="tabela_uploads_1" class="table table-striped table-bordered">
                                                        

                                                        <thead>
                                                            <tr>         
                                                                <th class="hidden-xs">#</th>
                                                                <th class="col-text">Nome</th>
                                                                <th class="col-text">Subcritério</th>
                                                                <th class="col-text">Pontuação</th>
                                                                <th class="text-center">
                                                                    <span class="glyphicon glyphicon-wrench"></span>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $var_documento = [$_SESSION['id_usuario'], '1'];
                                                            $documento = get_data($sql_documento, $var_documento);
                                                            $order=1;
                                                            foreach ($documento as $row) {
                                                                //while ($row = mysqli_fetch_array($result)) 
                                                                ?>                                                            <tr>                                                                
                                                                    <td class="hidden-xs"><?php echo $order++;?></td>
                                                                    <td><?php echo $row["nome"]; ?></td>
                                                                    <td><?php echo $row["id_subcriterio"]; ?></td>
                                                                    <td><?php echo $row["pontuacao"]; ?></td>
                                                                    <td align="center">
                                                                        <a class="btn btn-default">
                                                                            <span class="glyphicon glyphicon-pencil"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                        <a class="btn btn-danger"
                                                                           onclick="DeleteDocumento(<?php echo $row["id_documento"]; ?>)">
                                                                            <span class="glyphicon glyphicon-trash"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="tab-pane" role="tabpanel" id="step2">                                    
                                        <p id="msg"></p>                                       

                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="panel panel-default panel-table">
                                                <div class="panel-heading">
                                                    <div class="row">

                                                        <div class="col col-xs-6">
                                                            <h3 class="panel-title">Atividades Profissionais e Participação em eventos (na área de computação) (máximo 2,0 pontos)</h3>                                                            
                                                        </div>

                                                        <div class="col col-xs-6 text-right">
                                                            <div class="pull-right">
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <button type="button" class="btn btn-primary next-step">Save and continue</button>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="panel-body">
                                                    <div class="pull-left">   
                                                        <button
                                                            onclick="GetCriterio('2')"
                                                            type="button" 
                                                            name="criterio2" 
                                                            id_criterio="2" 
                                                            data-toggle="modal" 

                                                            class="btn btn-sm btn-primary btn-create">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                            Upload
                                                        </button>                                                                            
                                                    </div>
                                                    <table id="tabela_uploads_2" class="table table-striped table-bordered">
                                                        

                                                        <thead>
                                                            <tr>         
                                                                <th class="hidden-xs">#</th>
                                                                <th class="col-text">Nome</th>
                                                                <th class="col-text">Subcritério</th>
                                                                <th class="col-text">Pontuação</th>
                                                                <th class="text-center">
                                                                    <span class="glyphicon glyphicon-wrench"></span>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $var_documento = [$_SESSION['id_usuario'], '2'];
                                                            $documento = get_data($sql_documento, $var_documento);
                                                            foreach ($documento as $row) {
                                                                //while ($row = mysqli_fetch_array($result)) 
                                                                ?>                                                            <tr>                                                                
                                                                    <td class="hidden-xs">1</td>
                                                                    <td><?php echo $row["nome"]; ?></td>
                                                                    <td><?php echo $row["id_documento"]; ?></td>
                                                                    <td><?php echo $row["pontuacao"]; ?></td>
                                                                    <td align="center">
                                                                        <a class="btn btn-default">
                                                                            <span class="glyphicon glyphicon-pencil"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                        <a class="btn btn-danger"
                                                                           onclick="DeleteDocumento(<?php echo $row["id_documento"]; ?>)">
                                                                            <span class="glyphicon glyphicon-trash"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="tab-pane" role="tabpanel" id="step3">                                    
                                        <p id="msg"></p>                                       

                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="panel panel-default panel-table">
                                                <div class="panel-heading">
                                                    <div class="row">

                                                        <div class="col col-xs-6">
                                                            <h3 class="panel-title">Publicação (na área de computação) (máximo 4,0)</h3>                                                            
                                                        </div>

                                                        <div class="col col-xs-6 text-right">
                                                            <div class="pull-right">
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <button type="button" class="btn btn-primary next-step">Save and continue</button>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="panel-body">
                                                    <div class="pull-left">   
                                                        <button
                                                            onclick="GetCriterio('3')"
                                                            type="button" 
                                                            name="criterio1" 
                                                            id_criterio="3" 
                                                            data-toggle="modal" 

                                                            class="btn btn-sm btn-primary btn-create">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                            Upload
                                                        </button>                                                                            
                                                    </div>
                                                    <table id="tabela_uploads_3" class="table table-striped table-bordered">
                                                        

                                                        <thead>
                                                            <tr>         
                                                                <th class="hidden-xs">#</th>
                                                                <th class="col-text">Nome</th>
                                                                <th class="col-text">Subcritério</th>
                                                                <th class="col-text">Pontuação</th>
                                                                <th class="text-center">
                                                                    <span class="glyphicon glyphicon-wrench"></span>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $var_documento = [$_SESSION['id_usuario'], '3'];
                                                            $documento = get_data($sql_documento, $var_documento);
                                                            foreach ($documento as $row) {
                                                                //while ($row = mysqli_fetch_array($result)) 
                                                                ?>                                                            <tr>                                                                
                                                                    <td class="hidden-xs">1</td>
                                                                    <td><?php echo $row["nome"]; ?></td>
                                                                    <td><?php echo $row["id_documento"]; ?></td>
                                                                    <td><?php echo $row["pontuacao"]; ?></td>
                                                                    <td align="center">
                                                                        <a class="btn btn-default">
                                                                            <span class="glyphicon glyphicon-pencil"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                        <a class="btn btn-danger"
                                                                           onclick="DeleteDocumento(<?php echo $row["id_documento"]; ?>)">
                                                                            <span class="glyphicon glyphicon-trash"
                                                                                  aria-hidden="true"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                            </div>  
                                        </div>
                                    </div>


                                    <div class="tab-pane" role="tabpanel" id="complete">
                                        <h3>Complete</h3>
                                        <p>You have successfully completed all steps.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                        </div>
                        </form>
                </div>
                </section>


            </div>
        </div>
    </div>        
</body>  
</html>  

<div  class="modal fade" id="add_data_Modal">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="exampleModalLabel">Upload Documentos - </h4>                
            </div>            
            <form id='insert_form'method="post" enctype="multipart/form-data">
                <input type='hidden' id="id_usuario" name='id_usuario' value="<?php echo $_SESSION['id_usuario']; ?>">                
                <input type="hidden" name="doc_criterio" id="doc_criterio">

                <div class="modal-body">                    
                    <div class="form-group">
                        <label for="doc_nome">Descrição:</label>
                        <input type="text" class="form-control" id="doc_nome" placeholder="Descrição" name="doc_nome">
                    </div>

                    <div class="form-group">
                        <label for="doc_subcriterio">Subcritério</label>                                                
                        <div class="subcriterio_content"></div>
                    </div>

                    <div class="form-group">
                        <label for="doc_pontuacao">Pontuação:</label>
                        <input type="text" class="form-control" id="doc_pontuacao" placeholder="Pontuação" name="doc_pontuacao">
                    </div>

                    <div class="checkbox">                           
                        <input type='file' name='file' id='file'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
                    <button type="submit" id="upload" class="btn btn-default">Upload</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Visualização do documento</h4>
            </div>
            <div class="modal-body" id="employee_detail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>