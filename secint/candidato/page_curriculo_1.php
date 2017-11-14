<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$vars = [$id];
//var_dump($vars);
$sql_identificacao = "SELECT * FROM identificacao WHERE id_usuario =?";
$identificacao = get_data($sql_identificacao, $vars);
//var_dump($identificacao);
$sql_criterio = "select * from criterio where id_criterio=?";
$sql_subcriterio = "select * from subcriterio where id_criterio=?";
$sql_documento = "select * from documento INNER JOIN subcriterio ON documento.id_subcriterio=subcriterio.id_subcriterio INNER JOIN criterio ON subcriterio.id_criterio=criterio.id_criterio where criterio.id_criterio=? and id_usuario=?";
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">        
        <script type="text/javascript">

        </script>

    </head>  
    <body>  
        <div class="container">
            <div class="row">
                <section>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-folder-open"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-picture"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-ok"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">                                    
                                    <p id="msg"></p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                    <h4>Formação Acadêmica</h4>                                               
                                    <div class="container" style="width:700px;">                                       

                                        <div class="table-responsive">
                                            <div align="right">
                                                <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Upload</button>
                                            </div>
                                            <br />
                                            <div id="employee_table">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="70%">Employee Name</th>  
                                                        <th width="30%">View</th>
                                                    </tr>
                                                    <?php
                                                    //print '<pre>';
                                                    $var_criterio1 = ['1'];

                                                    $criterio1 = get_data($sql_criterio, $var_criterio1);
                                                    //print_r($criterio1);

                                                    $subcriterio1 = get_data($sql_subcriterio, $var_criterio1);
                                                    //print_r($subcriterio1);

                                                    $var_documento1 = ['1', '1'];

                                                    $documento1 = get_data($sql_documento, $var_documento1);
                                                    //print_r($documento1);
                                                    //print '</<pre>';

                                                    foreach ($documento1 as $row) {
                                                        //while ($row = mysqli_fetch_array($result)) 
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row["nome"]; ?></td>
                                                            <td><input type="button" name="view" value="view" id="<?php echo $row["id_documento"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </table>

                                            </div>
                                        </div>  
                                    </div>



                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h3>Step 2</h3>
                                    <p>This is step 2</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h3>Step 3</h3>
                                    <p>This is step 3</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>Complete</h3>
                                    <p>You have successfully completed all steps.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>  
    </body>  
</html>  

<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="exampleModalLabel">Upload Documentos - </h4>
            </div>
            <form id='insert_form'method="post" enctype="multipart/form-data">
                <input type='hidden' id="id_usuario" name='id_usuario' value="1">                
                <input type="hidden" name="doc_criterio" id="doc_criterio" value="2">

                <div class="modal-body">                                
                    <div class="form-group">
                        <label for="doc_nome">Descrição:</label>
                        <input type="text" class="form-control" id="doc_nome" placeholder="Descrição" name="doc_nome">
                    </div>

                    <div class="form-group">
                        <label for="doc_subcriterio">Subcritério:</label>
                        <input type="text" class="form-control" id="doc_subcriterio" placeholder="Subcritério" name="doc_subcriterio">
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