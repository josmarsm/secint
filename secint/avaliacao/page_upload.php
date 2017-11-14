<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$vars = [$id];
$sql = "SELECT * FROM candidato WHERE id_candidato =?";
$candidato = get_data($sql, $vars);
//var_dump($candidato);
?>

<div class="wrapper" role="main">
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <?php
                if (isset($_GET['mensagem'])) {
                    $mensagem = unserialize($_GET['mensagem']);
                    echo $mensagem;
                }
                ?>
            </div>
        </div>                 
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    echo '<b>' . utf8_encode($candidato[0]['nome']) . '</b> - Envio de Documentos';
                    ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#profile-pills" data-toggle="tab">Dados Pessoais</a>
                        </li>
                        <li><a href="#formacao-pills" data-toggle="tab">Formação Acadêmica</a>
                        </li>
                        <li><a href="#atividade-pills" data-toggle="tab">Atividades Profissionais e Participação em eventos</a>
                        </li>
                        <li><a href="#publicacao-pills" data-toggle="tab">Publicação</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="profile-pills">
                            <h4>Formulário de Identificação</h4>

                            <div class="panel-body">
                                <div class="panel panel-default">

                                    Nome: <br>
                                    Linha de Pesquisa 1 <br>
                                    Linha de Pesquisa 2 <br>

                                    Orientador 1<br>
                                    Orientador 2<br>
                                    Orientador 3<br>

                                    POSCOMP <br>
                                    ano poscomp <br>
                                    nota poscomp <br>

                                    Bolsa <br>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="formacao-pills">                            
                            <h4>Formação Acadêmica (máximo 4,0 pontos</h4>                            
                            <div class="panel-body">
                                <h2>Transfers:</h2>

                                <p>
                                    <a class="btn btn-small btn-success" ng-click="$flow.resume()">Upload</a>
                                    <a class="btn btn-small btn-danger" ng-click="$flow.pause()">Pause</a>
                                    <a class="btn btn-small btn-info" ng-click="$flow.cancel()">Cancel</a>
                                    <span class="label label-info">Size: {{$flow.getSize()}}</span>
                                    <span class="label label-info">Is Uploading: {{$flow.isUploading()}}</span>
                                </p>
                                <table class="table table-hover table-bordered table-striped" flow-transfers>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Relative Path</th>
                                            <th>Unique Identifier</th>
                                            <th>#Chunks</th>
                                            <th>Progress</th>
                                            <th>Paused</th>
                                            <th>Uploading</th>
                                            <th>Completed</th>
                                            <th>Settings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="file in transfers">
                                            <td>{{$index + 1}}</td>
                                            <td>{{file.name}}</td>
                                            <td>{{file.size}}</td>
                                            <td>{{file.relativePath}}</td>
                                            <td>{{file.uniqueIdentifier}}</td>
                                            <td>{{file.chunks.length}}</td>
                                            <td>{{file.progress()}}</td>
                                            <td>{{file.paused}}</td>
                                            <td>{{file.isUploading()}}</td>
                                            <td>{{file.isComplete()}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-mini btn-warning" ng-click="file.pause()" ng-hide="file.paused">
                                                        Pause
                                                    </a>
                                                    <a class="btn btn-mini btn-warning" ng-click="file.resume()" ng-show="file.paused">
                                                        Resume
                                                    </a>
                                                    <a class="btn btn-mini btn-danger" ng-click="file.cancel()">
                                                        Cancel
                                                    </a>
                                                    <a class="btn btn-mini btn-info" ng-click="file.retry()" ng-show="file.error">
                                                        Retry
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion1" href="#formacao1">Especialização na área com duração mínima de 360 horas</a>
                                            </h4>
                                        </div>
                                        <div id="formacao1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion1" href="#formacao2">Especialização/Mestrado em área afim com duração mínima de 360 horas</a>
                                            </h4>
                                        </div>
                                        <div id="formacao2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion1" href="#formacao3">Participação em Projetos de  Pesquisa com bolsa (com carga horária mínima de 240 horas no semestre)</a>
                                            </h4>
                                        </div>
                                        <div id="formacao3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion1" href="#formacao4">Participação em Projetos de Pesquisa sem bolsa
                                                    (com carga horária mínima de 240 horas no semestre)
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="formacao4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion1" href="#formacao5">Participação em Projetos de Ensino ou Extensão
                                                    (com carga horária mínima de 60 horas no semestre)
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="formacao5" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="atividade-pills">
                            <h4>Atividades Profissionais e Participação em eventos na área de computação (máximo 2,0 pontos)</h4>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade1">Atividades docentes (após a graduação)</a>
                                            </h4>
                                        </div>
                                        <div id="atividade1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade2">Atividades profissionais (após a graduação)</a>
                                            </h4>
                                        </div>
                                        <div id="atividade2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade3">Estágio ou participação em empresa júnior</a>
                                            </h4>
                                        </div>
                                        <div id="atividade3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade4">Participação em evento na condição de organizador</a>
                                            </h4>
                                        </div>
                                        <div id="atividade4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade5">Participação em evento na condição de palestrante</a>
                                            </h4>
                                        </div>
                                        <div id="atividade5" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#atividade6">Participação em evento na condição de ouvinte</a>
                                            </h4>
                                        </div>
                                        <div id="atividade6" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="publicacao-pills">
                            <h4>Publicação na área de computação (máximo 4,0)</h4>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion3" href="#publicacao1">Em âmbito internacional</a>
                                            </h4>
                                        </div>
                                        <div id="publicacao1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion3" href="#publicacao2">Em âmbito nacional</a>
                                            </h4>
                                        </div>
                                        <div id="publicacao2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion3" href="#publicacao3">Em âmbito regional</a>
                                            </h4>
                                        </div>
                                        <div id="publicacao3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion3" href="#publicacao4">Resumo</a>
                                            </h4>
                                        </div>
                                        <div id="publicacao4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>