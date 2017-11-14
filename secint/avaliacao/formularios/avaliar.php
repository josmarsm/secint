<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Propeller is a front-end responsive framework based on Material design & Bootstrap.">
        <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
        <title>Accordion - Style - Propeller</title>
        <!-- favicon --> 
        <link rel="icon" href="http://propeller.in/assets/images/favicon.ico" type="image/x-icon">
        <link href="/selecao/includes/selecao/google-icons.css" type="text/css" rel="stylesheet" />
        <link href="/selecao/includes/selecao/accordion.css" type="text/css" rel="stylesheet" /> 
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body>
        <!--Accordion -->
        <div class="pmd-content pmd-content-custom" id="content"> 
            <!--component header -->
            <div class="componant-title-bg"> 
            </div> <!--component header end-->
            <div class="container">
                <!-- Accordion with colored icon-->
                <section class="row component-section">
                    <div class="col-md-9"> 
                        <!--Accordion with colored icon code and example  -->
                        <div class="component-box">
                            <!--Accordion with colored icon example -->
                            <div class="panel-group pmd-accordion" id="accordion4" role="tablist" aria-multiselectable="true" > 

                                <div class="panel panel-warning">                                    
                                    <div class="panel-heading" 
                                         role="tab" 
                                         id="headingOne">
                                        <h4 class="panel-title">
                                            <a 
                                                data-toggle="collapse" 
                                                data-parent="#accordion4" 
                                                href="#collapseOne4" 
                                                aria-expanded="true" 
                                                aria-controls="collapseOne4"  
                                                data-expandable="false">
                                                <i class="material-icons pmd-sm pmd-accordion-icon-left">
                                                    mood
                                                </i> 
                                                Ficha de Identificação
                                            </a> 
                                        </h4>
                                    </div>                                    
                                    <div 
                                        id="collapseOne4" 
                                        class="panel-collapse collapse in" 
                                        role="tabpanel" 
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">                                            
                                            <?php
                                            global $db;

                                            $parametro_identificacao = 64;

                                            $sql_identificacao = 'select * from identificacao where id_usuario=:parametro_identificacao';
                                            $result_identificacao = $db->prepare($sql_identificacao);
                                            $result_identificacao->bindParam(':parametro_identificacao', $parametro_identificacao);
                                            $result_identificacao->execute();
                                            $count = $result_identificacao->rowCount();
                                            $rows = $result_identificacao->fetchAll(PDO::FETCH_ASSOC);

                                            if ($count > 0) {
                                                $acao = 'view_identificacao';
                                            } else {
                                                $acao = 'add_identificacao';
                                            }

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
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-danger"> 
                                    <div class="panel-heading" 
                                         role="tab" 
                                         id="headingTwo">
                                        <h4 class="panel-title">
                                            <a  
                                                data-toggle="collapse" 
                                                data-parent="#accordion4" 
                                                href="#collapseTwo4" 
                                                aria-expanded="false" 
                                                aria-controls="collapseTwo4"  
                                                data-expandable="false">
                                                <i class="material-icons pmd-sm pmd-accordion-icon-left">
                                                    account_balance
                                                </i> 
                                                Ficha de Avaliação 
                                            </a> 
                                        </h4>
                                    </div>
                                    <div 
                                        id="collapseTwo4" 
                                        class="panel-collapse collapse" 
                                        role="tabpanel" 
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <?php
                                            include 'curriculo.php';
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-success"> 
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title"> 
                                            <a  data-toggle="collapse" data-parent="#accordion4" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4"  data-expandable="false"><i class="material-icons pmd-sm pmd-accordion-icon-left">verified_user</i> Quadro de Notas </a> </h4>
                                    </div>
                                    <div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">Not every website needs an accordion menu and you certainly won’t find them all the time. But that’s no reason to ignore the concept entirely. The purpose of an accordion menu is to manage an overabundance of content through dynamic switching. Each interface works differently based on the circumstances of the layout. </div>
                                    </div>
                                </div>

                                <div class="panel panel-info"> 
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title"><a  data-toggle="collapse" data-parent="#accordion4" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4"  data-expandable="false"><i class="material-icons pmd-sm pmd-accordion-icon-left">account_box</i> Quadro de Observações </a> </h4>
                                    </div>
                                    <div id="collapseFour4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">So when exactly should you use accordions? Mostly with larger menus or content which might behave cleaner using expandable sections. These could be sub-headings or even multiple levels – the point is to organize content in a way that makes navigation simpler than endless scrolling. </div>
                                    </div>
                                </div>

                            </div> <!--Accordion with colored icon example end-->
                        </div> <!--Accordion with colored icon code and example end -->
                    </div>
                </section> <!-- Accordion with colored icon end -->
            </div>
        </div> <!--Accordion constructor end -->
    </body>    

</html>
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