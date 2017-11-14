<?php
global $db;
$row_candidato = "<script>document.write(row_candidato)</script>";
echo 'este é o roew'.$row_candidato;

$parametro_identificacao = 64;

$sql_identificacao = 'select * from identificacao where id_usuario=:parametro_identificacao';
$result_identificacao = $db->prepare($sql_identificacao);
$result_identificacao->bindParam(':parametro_identificacao', $parametro_identificacao);
$result_identificacao->execute();
$count = $result_identificacao->rowCount();
$rows = $result_identificacao->fetchAll(PDO::FETCH_ASSOC);

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
        $parametro_candidato = $rows[0]['id_usuario'];
        $sql_candidato = "select * from usuario where id_usuario=:parametro_candidato";
        $result_candidato = $db->prepare($sql_candidato);
        $result_candidato->bindParam(':parametro_candidato', $parametro_candidato);
        $result_candidato->execute();
        $candidato = $result_candidato->fetchAll(PDO::FETCH_ASSOC);
        $nome_candidato = $candidato[0]['nome'];


        $parametro_linha1 = $rows[0]['linha_pesquisa_1'];
        $sql_linha1 = "select * from linha_pesquisa where id_linha_pesquisa=:parametro_linha1";
        $result_linha1 = $db->prepare($sql_linha1);
        $result_linha1->bindParam(':parametro_linha1', $parametro_linha1);
        $result_linha1->execute();
        $linha1 = $result_linha1->fetchAll(PDO::FETCH_ASSOC);
        if (count($linha1) > 0) {
            $linha_pesquisa_1 = $linha1[0]['linha_pesquisa'];
        } else {
            $linha_pesquisa_1 = 'Não informado';
        }


        $parametro_linha2 = $rows[0]['linha_pesquisa_2'];
        $sql_linha2 = "select * from linha_pesquisa where id_linha_pesquisa=:parametro_linha2";
        $result_linha2 = $db->prepare($sql_linha2);
        $result_linha2->bindParam(':parametro_linha2', $parametro_linha2);
        $result_linha2->execute();
        $linha2 = $result_linha2->fetch(PDO::FETCH_ASSOC);
        if (count($linha2) < 0) {
            $linha_pesquisa_2 = $linha2[0]['linha_pesquisa'];
        } else {
            $linha_pesquisa_2 = 'Não informado';
        }

        $parametro_orientador1 = $rows[0]['orientador_1'];
        $sql_orientador1 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=:parametro_orientador1";
        $result_orientador1 = $db->prepare($sql_orientador1);
        $result_orientador1->bindParam(':parametro_orientador1', $parametro_orientador1);
        $result_orientador1->execute();
        $orientador1 = $result_orientador1->fetchAll(PDO::FETCH_ASSOC);

        $parametro_orientador2 = $rows[0]['orientador_2'];
        $sql_orientador2 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=:parametro_orientador2";
        $result_orientador2 = $db->prepare($sql_orientador2);
        $result_orientador2->bindParam(':parametro_orientador2', $parametro_orientador2);
        $result_orientador2->execute();
        $orientador2 = $result_orientador2->fetchAll(PDO::FETCH_ASSOC);

        $parametro_orientador3 = $rows[0]['orientador_3'];
        $sql_orientador3 = "SELECT orientador.id_orientador,
                                        usuario.nome
                                        FROM
                                        orientador
                                        INNER JOIN usuario
                                        ON orientador.id_usuario = usuario.id_usuario                                        
                                        where id_orientador=:parametro_orientador3";
        $result_orientador3 = $db->prepare($sql_orientador3);
        $result_orientador3->bindParam(':parametro_orientador3', $parametro_orientador3);
        $result_orientador3->execute();
        $orientador3 = $result_orientador3->fetchAll(PDO::FETCH_ASSOC);

        if ($rows[0]['poscomp'] == 'Sim') {
//echo $rows[0]['poscomp'];
            $poscomp = $rows[0]['poscomp'] . ' [' . $rows[0]['ano_poscomp'] . ' - ' . $rows[0]['nota_poscomp'] . ' pontos]';
        } else {
            $poscomp = $rows[0]['poscomp'];
        }
        echo 'Nome: ' . $nome_candidato . ''
        . '<button type="button" '
        . 'data-id = "' . $rows[0]['id_identificacao'] . '"'
        . 'data-toggle = "modal"'
        . 'data-target = "#identificacao_edit"'
        . 'data-remote = "false"'
        . 'data-title = "Upload de documentos do Candidato [XXXXX]"'
        . 'data-button = "Editar"'
        . 'class="btn btn-link">'
        . 'Editar'
        . '</button> <br>';
        
        echo 'Linhas de Pesquisa: ' . $linha_pesquisa_1 . ', ' . $linha_pesquisa_2 . '<br>';
        echo 'Orientadores: ' . $orientador1[0]['nome'] . ', ' . $orientador2[0]['nome'] . ', ' . $orientador3[0]['nome'] . '<br>';
        echo 'Poscomp: ' . $poscomp . '<br>';
        echo 'Gostaria de Receber bolsa?: ' . $rows[0]['bolsa'];


        break;
}
?>
<div class = "modal fade" id = "identificacao_add" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "identificacao_add" aria-label = "Close"><span aria-hidden = "true">&times;
                    </span></button>
                <h4 class = "modal-title" id = "myModalLabel">Modal title</h4>
            </div>
            <div class = "modal-body">
                identificacao_edit.php
            </div>
            <div class = "modal-footer">
                <button type = "button" class = "btn btn-default hidden new" data-dismiss = "modal">Novo botão</button>
                <button type = "button" class = "btn btn-default" data-dismiss = "identificacao_add">Close</button>
                <button type = "button" class = "btn btn-primary close-changes">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class = "modal fade" id="identificacao_edit" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <button
                    onclick="fechaModal('identificacao_edit')"
                    type = "button" 
                    class = "close" 
                    data-dismiss = "identificacao_edit" 
                    aria-label = "Close"
                    ><span aria-hidden = "true">&times;
                    </span>
                </button>
                <h4 class = "modal-title" id = "myModalLabel">Edição do formulário de identificação</h4>
            </div>
            <div class = "modal-body">
                identificacao_edit.php
                <p id="demo">Click the button to change the text in this paragraph.</p>
            </div>
            <div class = "modal-footer">
                <button type = "button" class = "btn btn-default hidden new" data-dismiss = "modal">Novo botão</button>
                <button 
                    onclick="fechaModal('identificacao_edit')" 
                    id="identificacao_edit">
                    Try it
                </button>
                <button type = "button" class = "btn btn-primary close-changes">Save changes</button>
            </div>
        </div>
    </div>

</div>

