<div class="panel-body">
    <h4>Formação Acadêmica (máximo 4,0 pontos)</h4> 
    <h4>Documentos Anexados:</h4>                                
    <table class="table table-hover table-bordered table-striped" flow-transfers>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome do Documento</th>
                <th>Tipo do Documento</th>
                <th>Data Inclusão</th>
                <th>Pontuação Solicitada</th>                                            
                <th>Settings</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="file in transfers">
                <td>{{$index + 1}}</td>
                <td>{{file.name}}</td>
                <td>{{file.size}}</td>
                <td>{{file.relativePath}}</td>                                            
                <td>{{file.isComplete()}}</td>
                <td>
                    <div class="btn-group">

                        <button title="View" type="button" class="btn btn-info" data-title="View" data-toggle="modal" data-target="#view">
                            <i class="glyphicon glyphicon-search">
                            </i>
                        </button>

                        <button title="Edit" type="button" class="btn btn-default" data-title="Edit" data-toggle="modal" data-target="#edit">
                            <i class="glyphicon glyphicon-pencil">
                            </i>
                        </button>

                        <button title="Delete" type="button" class="btn btn-danger" data-title="Delete" data-toggle="modal" data-target="#delete">
                            <i class="glyphicon glyphicon-trash">
                            </i>
                        </button>                                                    

                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <button type="button" class="btn btn-small btn-success" data-toggle="modal" data-target="#myModal">Upload de Documentos</button> 

    </p>
</div>