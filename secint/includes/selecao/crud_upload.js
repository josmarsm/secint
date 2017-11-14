function addRecord() {
    var criterio = $("input[name=doc_criterio]").val();
    var id_usuario = $("input[name=id_usuario]").val();
    var form = $('#insert_form')[0]; // You need to use standard javascript object here
    var form_data = new FormData(form);

    $.ajax({
        url: 'teste.php?funcao=AddDocumento', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response, data, msg, total_pontuacao) {
            $('#msg').html(response); // display success response from the PHP script
            $('#total_pontuacao').html(total_pontuacao);
            $('#insert_form')[0].reset();
            $('#add_data_Modal').modal('hide');            
            Atualiza_Documentos(criterio, id_usuario);

        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

// READ records
function readRecords() {
    $.get("teste2.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}




$(document).ready(function () {
    
    $('#insert_form').on('submit', function (event) {
        event.preventDefault();
        var criterio = $("input[name=doc_criterio]").val();
        var id_usuario = $("input[name=id_usuario]").val();
        var form = $('#insert_form')[0]; // You need to use standard javascript object here
        var form_data = new FormData(form);

        $.ajax({
            url: 'teste.php?funcao=AddDocumento', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response, data, msg, total_pontuacao) {
                $('#msg').html(response); // display success response from the PHP script
                $('#total_pontuacao').html(total_pontuacao);
                $('#insert_form')[0].reset();
                $('#add_data_Modal').modal('hide');
                //$('#tbody_uploads').html(data);
                //GetDocumentos(criterio);
                Atualiza_Documentos(criterio, id_usuario);

            },
            error: function (response) {
                $('#msg').html(response); // display error response from the PHP script
            }
        });
    });
});

function GetCriterio(criterio, titulo) {
    $("#doc_criterio").val(criterio);
    $.ajax({
        url: 'teste.php?funcao=GetCriterio', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: ['criterio=' + criterio],
        type: 'get',
        success: function (data, status) {
            $(".subcriterio_content").html(data);
            $("#add_data_Modal").modal("show");

        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

function Atualiza_Documentos(criterio, id_usuario) {

    $.ajax({
        url: 'teste.php?funcao=Atualiza_Documentos', // point to server-side PHP script 
        //dataType: 'json', // what to expect back from the PHP script
        //cache: false,
        //contentType: false,
        //processData: false,
        data: {criterio: criterio,
            id_usuario: id_usuario},
        method: 'post',
        success: function (data) {
            $('#tabela_uploads_' + criterio).html(data);
            //    $('#tabela_uploads_1').html(data);
            //records_content

        },
        error: function (response) {
            $('#msg').html(response); // display error response from the PHP script
        }
    });
}

function DeleteDocumento(id_documento) {

    var conf = confirm("Tem certeza de que deseja excluir o documento?");
    if (conf == true) {
        $.ajax({
            url: 'teste.php?funcao=Deleta_Documento',
            data: {id_documento: id_documento},
            method: 'post',
            success: function (response) {
                var criterio = $("input[name=doc_criterio]").val();
                var id_usuario = $("input[name=id_usuario]").val();
                Atualiza_Documentos(criterio, id_usuario);
            },
            error: function (response) {
                $('#msg').html(response); // display error response from the PHP script

            }
        });
    }
}

function Ativa_Tela(parametro1, parametro2) {
    $.ajax({
        success: function (response) {
            console.log(parametro1, parametro2);
        }
    });
}