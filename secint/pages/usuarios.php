
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Usuarios</title>
        <!--CSS-->    
        <link rel="stylesheet" href="media/css/bootstrap.css">
        <link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">
        <!--Javascript-->    
        <script src="media/js/jquery-1.10.2.js"></script>
        <script src="media/js/jquery.dataTables.min.js"></script>
        <script src="media/js/dataTables.bootstrap.min.js"></script>          
        <script src="media/js/bootstrap.js"></script>
        <script src="media/js/lenguajeusuario.js"></script>     
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>   
    </head>

    <body>
        <div class="col-md-8 col-md-offset-2">
            <h1>Clientes
                <a href="registrocliente.php" class="btn btn-primary pull-right menu"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Novo cliente</a>
            </h1>  
        </div>
        <div class="col-md-8 col-md-offset-2">    
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Curso</th>
                        <th>Telefone</th>               
                        <th>Email</th>
                        <th>Atendimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody> 
            </table>        
        </div>
    </body>
</html>
