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
        <script type="text/javascript">
            $(document).ready(function () {
                $('#insert_form').on('submit', function (event) {
                    event.preventDefault();
                    var form = $('#insert_form')[0]; // You need to use standard javascript object here
                    var form_data = new FormData(form);

                    $.ajax({
                        url: 'upload_1.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#msg').html(response); // display success response from the PHP script
                            $('#insert_form')[0].reset();
                            $('#add_data_Modal').modal('hide');
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the PHP script
                        }
                    });
                });
            });
        </script>

    </head>  
    <body>  
        <div class="container">
            <p id="msg"></p>
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
                    <div class="container" style="width:700px;">  
                        <h3 align="center">Upload de Documentos</h3>  
                        <br />
                        <p id="msg"></p>
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