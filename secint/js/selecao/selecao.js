function all_candidatos_comissao() {
    dataTable_comissao = $('#candidato_data_comissao').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "crud/crud.php?acao=all_candidatos_comissao",
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 3, 4],
                "orderable": false
            }
        ]
    });
}

function all_candidatos_orientador() {
    dataTable_comissao = $('#candidato_data_orientador').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "crud/crud.php?acao=all_candidatos_orientador",
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 3, 4],
                "orderable": false
            }
        ]
    });
}

function one_candidatos_comissao(id_candidato) {
    $.ajax({
        url: "crud/crud.php?acao=one_candidato_comissao",
        method: "POST",
        data: {id_candidato: id_candidato},
        dataType: "json",
        success: function (data)
        {

            $('#candidatoModal_comissao').modal('show');
            candidato_form_comissao.reset();
            var nome_candidato = data.nome_candidato;
            $('.modal-title').text('Avaliação do candidato [' + nome_candidato + ']');
            $('#linha_pesquisa_1').val(data.linha_pesquisa_1);
            $('#linha_pesquisa_2').val(data.linha_pesquisa_2);
            $('#orientador_1').val(data.orientador_1);
            $('#orientador_2').val(data.orientador_2);
            $('#orientador_3').val(data.orientador_3);
            if (data.poscomp === 'Sim') {
                console.log('poscomp sim');
                $('input[name=poscomp][value=Sim]').prop('checked', 'checked');
                habilita_campos();
            } else {
                console.log('poscomp não');
                $('input[name=poscomp][value=Nao]').prop('checked', 'checked');
                desabilita_campos();
            }
            $('#ano_poscomp').val(data.ano_poscomp);
            $('#nota_poscomp').val(data.nota_poscomp);
            $('input[name=bolsa][value=' + data.bolsa + ']').attr('checked', 'checked');
            $('#nota_curriculo').val(data.nota_curriculo);
            $('#id_candidato').val(data.id_candidato);
            $('#action').val("Salvar");
            all_observacao(id_candidato);
            $('#salva_observacao').attr('onclick', 'salva_observacao(' + id_candidato + ')');
        }
    });
}

function one_candidatos_orientador(id_candidato) {
    $.ajax({
        url: "crud/crud.php?acao=one_candidato_orientador",
        method: "POST",
        data: {id_candidato: id_candidato},
        dataType: "json",
        success: function (data)
        {

            $('#candidatoModal_orientador').modal('show');
            candidato_form_orientador.reset();
            var nome_candidato = data.nome_candidato;
            $('.modal-title').text('Avaliação do candidato [' + nome_candidato + ']');
            $('#linha_pesquisa_1').val(data.linha_pesquisa_1);
            $('#linha_pesquisa_2').val(data.linha_pesquisa_2);
            $('#orientador_1').val(data.orientador_1);
            $('#orientador_2').val(data.orientador_2);
            $('#orientador_3').val(data.orientador_3);

            $('#nota_curriculo').val(data.nota_curriculo);
            if (data.poscomp === 'Sim') {
                $('#poscomp').val(data.poscomp + ' [' + data.ano_poscomp + ' - ' + data.nota_poscomp + ' pontos]');
                $('#nota_prova').prop("readonly", true);
            } else {
                $('#poscomp').val(data.poscomp);
                $('#nota_prova').prop("readonly", false);
            }

            $('#bolsa').val(data.bolsa);
            $('#nota_prova').val(data.nota_prova);
            $('#nota_entrevista').val(data.nota_entrevista);
            $('#id_candidato').val(data.id_candidato);
            $('#action').val("Salvar");
            $('#operation').val("Edit");
            all_observacao(id_candidato);
            $('#salva_observacao').attr('onclick', 'salva_observacao(' + id_candidato + ')');
        }
    });
}

function salva_candidato_comissao() {
    var formulario = document.getElementById("candidato_form_comissao");
    var formData = new FormData(formulario);
    //formData.getAll(id_identificacao);
    $.ajax({
        url: "crud/crud.php?acao=salva_candidato_comissao",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data)
        {
            dataTable_comissao.ajax.reload();
            alert(data);
            $('#candidato_form_comissao')[0].reset();
            $('#candidatoModal_comissao').modal('hide');

        }
    });
}

function salva_candidato_orientador() {
    var formulario = document.getElementById("candidato_form_orientador");
    var formData = new FormData(formulario);
    //formData.getAll(id_identificacao);
    $.ajax({
        url: "crud/crud.php?acao=salva_candidato_orientador",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data)
        {
            dataTable_comissao.ajax.reload();
            alert(data);
            $('#candidato_form_orientador')[0].reset();
            $('#candidatoModal_orientador').modal('hide');

        }
    });
}

function salva_observacao(id_candidato) {
    var observacao = jQuery("#textoObservacao").val();
    //var id_candidato = '1';
    $.ajax({
        url: "crud/crud.php?acao=salva_observacao",
        method: "post",
        data: {id_candidato: id_candidato, observacao: observacao},
        dataType: "json",
        complete: function (response)
        {
            alert(response.responseText);
            $("#textoObservacao").val("");
            all_observacao(id_candidato)
        }
    });
}

function all_observacao(id_candidato) {
    $.ajax({
        url: "crud/crud.php?acao=all_observacao",
        method: "post",
        data: {id_candidato: id_candidato},
        dataType: "json",
        success: function (data)
        {
            
            
            if (data === 0) {
                $("#observacao").html("Sem observações");
            } else {
                $("#observacao").html("");
                $.each(data.observacoes, function (i, dat) {
                    $("#observacao").append(
                            '<div class="header">' +
                            '<strong class="primary-font">' + dat.nome + '</strong>' +
                            '<small class="pull-right text-muted">' +
                            '<i class="fa fa-clock-o fa-fw"></i>' + dat.data_registro +
                            '</small>' +
                            '</div>' +
                            '<p>' + dat.observacao + '</p>' +
                            '<hr>'
                            );
                });
            }

        }
    });
}


function readRecordsComissao() {
    dataTable_comissao = $('#candidato_data_comissao').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "crud/fetch_comissao.php",
            type: "POST"
        },

        "columnDefs": [
            {
                "targets": [0, 3, 4],
                "orderable": false
            }
        ]
    });
}


function readRecordsOrientador() {
    dataTable_orientador = $('#candidato_data_orientador').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "crud/fetch_orientador.php",
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 3, 4],
                "orderable": false
            }
        ]
    });
}
;


function addRecord() {
// get values
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    // Add record
    $.post("ajax/addRecord.php", {
        first_name: first_name,
        last_name: last_name,
        email: email
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        // read records again
        readRecords();
        // clear fields from the popup
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
    });
}

// READ records
function readRecords1() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function readRecords() {
    dataTable.ajax.reload();
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf === true) {
        $.post("ajax/deleteUser.php", {
            id: id
        },
                function (data, status) {
                    // reload Users by using readRecords();
                    readRecords();
                }
        );
    }
}

function GetUserDetails(id) {
// Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
        id: id
    },
            function (data, status) {
                // PARSE json data
                var user = JSON.parse(data);
                // Assing existing values to the modal popup fields
                $("#update_first_name").val(user.first_name);
                $("#update_last_name").val(user.last_name);
                $("#update_email").val(user.email);
            }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function GetCandidatoDetailsComissao(id_identificacao) {
//var user_id = id_identificacao;
    $.ajax({
        url: "crud/fetch_single_comissao.php",
        method: "POST",
        data: {id_identificacao: id_identificacao},
        dataType: "json",
        success: function (data)
        {
            $('#candidatoModal_comissao').modal('show');
            candidato_form_comissao.reset();
            var nome_candidato = data.nome_candidato;
            $('.modal-title').text('Avaliação do candidato [' + nome_candidato + ']');
            $('#linha_pesquisa_1').val(data.linha_pesquisa_1);
            $('#linha_pesquisa_2').val(data.linha_pesquisa_2);
            $('#orientador_1').val(data.orientador_1);
            $('#orientador_2').val(data.orientador_2);
            $('#orientador_3').val(data.orientador_3);
            if (data.poscomp === 'Sim') {
                console.log('poscomp sim');
                $('input[name=poscomp][value=Sim]').prop('checked', 'checked');
                habilita_campos();
            } else {
                console.log('poscomp não');
                $('input[name=poscomp][value=Nao]').prop('checked', 'checked');
                desabilita_campos();
            }

            $('#ano_poscomp').val(data.ano_poscomp);
            $('#nota_poscomp').val(data.nota_poscomp);
            $('input[name=bolsa][value=' + data.bolsa + ']').attr('checked', 'checked');
            $('#nota_curriculo').val(data.nota_curriculo);
            $('#id_identificacao').val(data.id_identificacao);
            $('#action').val("Salvar");
            $('#operation').val("Edit");
        }
    });
}

function GetCandidatoDetailsOrientador(id_identificacao) {
//var user_id = id_identificacao;
    $.ajax({
        url: "crud/fetch_single_orientador.php",
        method: "POST",
        data: {id_identificacao: id_identificacao},
        dataType: "json",
        success: function (data)
        {
            $('#candidatoModal_orientador').modal('show');
            candidato_form_orientador.reset();
            var nome_candidato = data.nome_candidato;
            $('.modal-title').text('Avaliação do candidato [' + nome_candidato + ']');
            $('#linha_pesquisa_1').val(data.linha_pesquisa_1);
            $('#linha_pesquisa_2').val(data.linha_pesquisa_2);
            $('#orientador_1').val(data.orientador_1);
            $('#orientador_2').val(data.orientador_2);
            $('#orientador_3').val(data.orientador_3);

            $('#nota_curriculo').val(data.nota_curriculo);
            if (data.poscomp === 'Sim') {
                $('#poscomp').val(data.poscomp + ' [' + data.ano_poscomp + ' - ' + data.nota_poscomp + ' pontos]');
                $('#nota_prova').prop("readonly", true);
            } else {
                $('#poscomp').val(data.poscomp);
                $('#nota_prova').prop("readonly", false);
            }

            $('#bolsa').val(data.bolsa);
            $('#nota_prova').val(data.nota_prova);
            $('#nota_entrevista').val(data.nota_entrevista);
            $('#id_identificacao').val(data.id_identificacao);
            $('#action').val("Salvar");
            $('#operation').val("Edit");
        }
    });
}

function UpdateCandidatoDetailsOrientador(id_identificacao, nota_prova, nota_entrevista) {
    $.ajax({
        url: "crud/updateCandidatoDetailsOrientador.php",
        method: 'POST',
        data: {id_identificacao: id_identificacao,
            linha_pesquisa_1: linha_pesquisa_1,
            nota_curriculo: nota_curriculo},
        contentType: false,
        processData: false,
        success: function (data, status)
        {
            alert(data);
            //$('#user_form')[0].reset();
            $('#candidatoModal').modal('hide');
            readRecordsOrientador();
        }
    });


}

$(document).on('submit', '#candidato_form', function (event) {
    event.preventDefault();
    $.ajax({
        url: "crud/updateCandidatoDetails.php",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (data)
        {
            dataTable_comissao.ajax.reload();
            alert(data);
            $('#candidato_form')[0].reset();
            $('#candidatoModal').modal('hide');

        }
    });

});

$(document).on('submit', '#candidato_form', function (event) {
    event.preventDefault();
    $.ajax({
        url: "crud/updateCandidatoDetailsOrientador.php",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (data)
        {
            dataTable_orientador.ajax.reload();
            alert(data);
            $('#candidato_form_orientador')[0].reset();
            $('#candidatoModal_orientador').modal('hide');
            dataTable_orientador.ajax.reload();
        }
    });

});

function chamaPerfil() {

    window.location.replace("?p=perfil");
    $('#form_perfil')[0].reset();
    $(document).ready(function () {
        $('input[type="password_new"], select').val('');
    });
}

$(document).on('submit', '#form_perfil', function (event) {
    event.preventDefault();
    $.ajax({
        url: "crud/updatePerfil.php",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (data)
        {
            //dataTable.ajax.reload();
            alert(data);
            $('#form_perfil')[0].reset();
            window.location.replace("?p=home");
            //$('#candidatoModal').modal('hide');

        }
    });

});

function desabilita_campos() {
    $("#poscomp_complemento").attr('disabled', 'disabled');
    $("#poscomp_complemento").hide();
}

function habilita_campos() {
    $("#poscomp_complemento").removeAttr('disabled');
    $("#poscomp_complemento").show();
}
function inicio() {
    desabilita_campos();
}

$(document).ready(function () {
    $("#nota_curriculo").maskMoney({showSymbol: true, symbol: "", decimal: ".", thousands: ","});
    $("#nota_prova").maskMoney({showSymbol: true, symbol: "", decimal: ".", thousands: ","});
    $("#nota_entrevista").maskMoney({showSymbol: true, symbol: "", decimal: ".", thousands: ","});
    $("#poscomp").click(function () {
        var botao_poscomp = $('input[name=poscomp]:checked', '#candidato_form').val();
        if (botao_poscomp === 'Sim') {
            console.log('Clicou no sim');
        } else {
            console.log('Clicou no não');
        }
    });


    desabilita_campos();

    //To enable
    $("#poscomp_sim").click(function () {
        var card_type = $('input[name=poscomp]:checked', '#candidato_form').val();
        habilita_campos();

    });
    //To disable
    $("#poscomp_nao").click(function () {
        var card_type = $('input[name=poscomp]:checked', '#candidato_form').val();
        desabilita_campos();

    });
    $.noConflict();
    all_candidatos_comissao();
    all_candidatos_orientador();
});


//$('#nota_curriculo').mask('99.99');
