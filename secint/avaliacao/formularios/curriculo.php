<?php
include '../../funcoes/config.php';
global $db;

$parametro_identificacao = 64;
$sql_identificacao = 'select * from identificacao where id_usuario=:parametro_identificacao';
$result_identificacao = $db->prepare($sql_identificacao);
$result_identificacao->bindParam(':parametro_identificacao', $parametro_identificacao);
$result_identificacao->execute();
$count = $result_identificacao->rowCount();
$rows = $result_identificacao->fetchAll();

//print_r($count);
//print_r($rows);

if ($count > 0) {
    $acao = 'view_identificacao';
} else {
    $acao = 'add_identificacao';
}
//echo $acao;
//$acao = '';
switch ($acao) {
    case 'add_identificacao' :
        echo 'Formulário de adição de identificação <br>';
        break;
    case 'edit_identificacao':
        echo 'Formulário de edição de identificação';
        print_r($rows);

        break;
    default:

        echo 'Formação Acadêmica (máximo 4,0 pontos)<br>';
        echo '<table align="center" id = "mytable" cellpadding="10" border="1">
    <thead>
    <th><input type = "checkbox" id = "checkall" /></th>
    <th>Subcritério</th>
    <th style="width:90px text-align:center">Arquivo</th>
    <th style="width:130px text-align:center">Pontos Solicitados</th>
    <th style="width:110px text-align:center">Pontos Avaliados</th>
    <th style="text-align:center">Edit / Delete </th>    
</thead>
<tbody>
    <tr>
        <td><input type = "checkbox" class = "checkthis" /></td>
        <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
        <td style="text-align:center">arquivo</td>
        <td style="text-align:center">22</td>
        <td style="text-align:center">15</td>        
        <td style="text-align:center">           
                <button
                data-placement="top"
                title="Edit"
                class = "btn btn-primary btn-xs" 
                data-title = "Edit" 
                data-toggle = "modal" 
                    data-target = "#edit_curriculo" >
                    <span class = "glyphicon glyphicon-pencil"></span>
                </button>
           
            
                <button
                data-placement = "top"
                title = "Delete"
                class = "btn btn-danger btn-xs" 
                data-title = "Delete" 
                data-toggle = "modal" 
                data-target = "#delete_curriculo" >
                    <span class = "glyphicon glyphicon-trash"></span>
                </button>
           
        </td>
    </tr>
    <tr id="new_row">
        <td></td>
        <td COLSPAN="4" style="text-align:right">Inserir novos documentos</td>               
        <td style="text-align:center">
            
                <button data-placement = "top" 
            data-toggle = "tooltip" 
            title = "Insert"class = "btn btn-success btn-xs" 
                data-title = "Insert" 
                data-toggle = "modal" 
                data-target = "#insert" >
                    <span class = "glyphicon glyphicon-plus"></span>
                </button>
            
        </td>
    </tr>
</tbody>
</table>
<div data-backdrop="static" class="modal fade" id="edit_curriculo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="edit_curriculo" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div data-backdrop="static" class="modal fade" id="delete_curriculo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="xmodal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="xmodal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>'        
        ;
echo 'Atividades Profissionais e Participação em eventos (na área de computação) (máximo 2,0 pontos)<br>';
echo 'Publicação (na área de computação) (máximo 4,0)<br>';
break;
}
