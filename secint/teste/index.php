<?php ?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <!-- Link trigger modal -->
            <a 
                href="formularios/identificacao.php"
                data-id="1"
                data-toggle="modal" 
                data-target="#myModal" 
                data-remote="false"
                data-title="Este título é o atributo 1"
                data-button="Salva modal 1"            
                class="btn btn-primary btn-create">
                Launch Modal 1
            </a>

            <a 
                href="formularios/curriculo.php" 
                data-id="2"
                data-toggle="modal" 
                data-target="#myModal" 
                data-remote="false"
                data-button="Salva modal 2"
                data-title="Este título é o atributo 2"            
                class="btn btn-primary btn-create">
                Launch Modal 2
            </a>

            <!-- Default bootstrap modal example -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default hidden new" data-dismiss="modal">Novo botão</button>  
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary close-changes">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
   
</html>
