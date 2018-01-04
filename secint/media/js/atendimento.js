$(document).ready(function () {
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
});
function loadAtedimento(status) {
    //dataTable = $('#atendimento').DataTable();
    contaAtendimentoPrioridade();
    $("#lista_assunto").empty();
    if (status == undefined) {
        var status = 'Nao_Finalizado';
        $('#titulo_h1').html('Atendimentos não Finalizados');
        $('#status_atendimento').show();
        $('#status_atendimento').text("Finalizar Atendimento").attr({title: "Finalizar Atendimento", class: "btn btn-danger"});
        $('#salva_procedimento').removeAttr('disabled');
        $('#textoProcedimento').removeAttr('disabled');
        $('#status_atendimento').attr("data-status", "finaliza");
        tabela(status);
        //aTabela.ajax.reload();
    } else {
        var status = status;
        $('#titulo_h1').html('Atendimentos Finalizados');
        $('#status_atendimento').show();
        $('#status_atendimento').text("Ativar Atendimento").attr({title: "Ativar Atendimento", class: "btn btn-success"});
        $('#salva_procedimento').attr('disabled', 'disabled');
        $('#textoProcedimento').attr('disabled', 'disabled');
        $('#status_atendimento').attr("data-status", "ativa");
        tabela(status);
        //aTabela.ajax.reload();
    }

}

function tabela(status) {

    oTable = $('#atendimento').DataTable({
        destroy: true,
        stateSave: true,
        responsive: true,
        processing: true,
        ordering: false,
        ajax: {
            url: 'funcoes/crud.php?funcao=AllAtendimento&status=' + status,
            type: "POST"
        },
        columns: [{
                "data": "nome_curso"
            }, {
                "data": "nome_interessado"
            }, {
                "data": "assunto"
            }, {
                "data": "nome_atendente"
            }, {
                "data": "atendimento"
            }]
    });
    yadcf.init(oTable, [{
            column_number: 0,
            column_data_type: "html",
            html_data_type: "text",
            filter_default_label: "Selecione o curso"
        }, {
            column_number: 1,
            column_data_type: "html",
            html_data_type: "text",
            filter_default_label: "Selecione o Interessado"
        }, {
            column_number: 2,
            column_data_type: "html",
            html_data_type: "text",
            text_data_delimiter: ",",
            filter_type: "auto_complete",
            filter_default_label: "Informe o assunto"
        }, {
            column_number: 3,
            column_data_type: "html",
            html_data_type: "text",
            filter_default_label: "Selecione o Atendente"
        }]);
    $("#interessado").autocomplete({
        minLength: 2,
        appendTo: "#modal_atendimento",
        source: function (request, response) {
            $.ajax({
                url: "funcoes/crud.php",
                dataType: "json",
                data: {
                    funcao: 'buscaInteressado',
                    term: $('#interessado').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#interessado").val(ui.item.nome);
            //carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#interessado").val(ui.item.nome);
            $('#id_interessado').val(ui.item.id_interessado);
            $('#matricula').val(ui.item.matricula);
            //console.log(ui.item.id_interessado);
            $.ajax({
                url: "funcoes/crud.php",
                dataType: "json",
                data: {
                    funcao: 'AssuntoByInteressado',
                    term: ui.item.id_interessado
                },
                success: function (data) {
                    //var x = jQuery.parseJSON(data);
                    console.log(data);
                    $("#lista_assunto").show().html(data);
                }
            });

            return false;
        }
    })
            .autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>\n\
                        <b>Id: </b>" + item.id_interessado + " - <b>Nome: </b>" + item.nome + " - <b>Matricula: </b>" + item.matricula + "<br>\
                        <b>Curso: </b>" + item.nome_curso + "<br>\
                        <b>Email: </b>" + item.email + "<br>\
                        <b>Fone Residencial: </b>" + item.fone_residencial + " - <b>Fone Celular: </b>" + item.fone_celular + "\
                        </a><br>")
                .appendTo(ul);
    };
    $("#assunto").autocomplete({
        minLength: 0,
        appendTo: "#modal_atendimento",
        source: function (request, response) {
            $.ajax({
                url: "funcoes/crud.php",
                dataType: "json",
                data: {
                    funcao: 'buscaAssunto',
                    term: $('#assunto').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#assunto").val(ui.item.assunto);
            //carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#assunto").val(ui.item.assunto);
            $('#hidden_assunto').val(ui.item.assunto);
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.assunto + "</a><br>")
                .appendTo(ul);
    };
    $("#curso").autocomplete({
        minLength: 0,
        appendTo: "#modal_interessado",
        source: function (request, response) {
            $.ajax({
                url: "funcoes/crud.php",
                dataType: "json",
                data: {
                    funcao: 'buscaCurso',
                    term: $('#curso').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#curso").val(ui.item.nome_curso);
            //carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#curso").val(ui.item.nome_curso);
            $('#hidden_curso').val(ui.item.nome_curso);
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.nome_curso + "</a><br>")
                .appendTo(ul);
    };
    $("#categoria").autocomplete({
        minLength: 0,
        appendTo: "#modal_interessado",
        source: function (request, response) {
            $.ajax({
                url: "funcoes/crud.php",
                dataType: "json",
                data: {
                    funcao: 'buscaCategoria',
                    term: $('#categoria').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#categoria").val(ui.item.categoria);
            //carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#categoria").val(ui.item.categoria);
            $('#hidden_categoria').val(ui.item.categoria);
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a>" + item.categoria + "</a><br>")
                .appendTo(ul);
    };
    $('#assunto').on('keypress', function () {
        var regex = new RegExp("^[ 0-9a-zA-Zàèìòùáéíóúâêîôûãõ\b]+$");
        var _this = this;
        // Curta pausa para esperar colar para completar
        setTimeout(function () {
            var texto = $(_this).val();
            if (!regex.test(texto))
            {
                $(_this).val(texto.substring(0, (texto.length - 1)))
            }
        }, 100);
    });
    $('#curso').on('keypress', function () {
        var regex = new RegExp("^[ 0-9a-zA-Zàèìòùáéíóúâêîôûãõ\b]+$");
        var _this = this;
        // Curta upausa para esperar colar para completar
        setTimeout(function () {
            var texto = $(_this).val();
            if (!regex.test(texto))
            {
                $(_this).val(texto.substring(0, (texto.length - 1)))
            }
        }, 100);
    });
    $('#interessado').on('keypress', function () {
        var regex = new RegExp("^[ 0-9a-zA-Zàèìòùáéíóúâêîôûãõ\b]+$");
        var _this = this;
        // Curta upausa para esperar colar para completar
        setTimeout(function () {
            var texto = $(_this).val();
            if (!regex.test(texto))
            {
                $(_this).val(texto.substring(0, (texto.length - 1)))
            }
        }, 100);
    });
}
function contaAtendimentoPrioridade()
{
    $.ajax({
        url: 'funcoes/crud.php?funcao=contaAtendimentoPrioridade',
        type: "POST",
        //data: $('#form_atendimento').serialize(),
        //dataType: "JSON",
        success: function (data) {
            var x = jQuery.parseJSON(data);
            if (x.total_prioridade < 1) {
                $("#total_prioridade").hide();
            } else {
                $("#total_prioridade").show().html('<h4 class="alert-heading">Atenção!</h4> Existem {'
                        + x.total_prioridade
                        + '} atendimentos em situação de prioridade para acessá-los clique'
                        + '<a class="alert-link" onclick="allAtendimentoPrioridade()" id="allAtendimentoPrioridade">'
                        + ' aqui </a>.');
            }
        }
    });
}

function allAtendimentoPrioridade()
{
    verificaLogin();
    var titulo = 'Cadastro de Interessados';
    tabela_prioridade();
    $('#modal_prioridade').modal({show: true}); // show bootstrap modal
    //$('#modal_prioridade').css(';z-index', '10000');
    //$('#modal_atendimento').attr('style',';z-index:10000');
}


function tabela_prioridade() {
    $('#atendimento_prioridade').DataTable({
        destroy: true,
        stateSave: true,
        responsive: true,
        processing: true,
        ordering: false,
        bAutoWidth: false,
        ajax: {
            url: 'funcoes/crud.php?funcao=AllAtendimentoPrioridade',
            type: 'POST'
        },
        //sAjaxSource: "funcoes/crud.php?funcao=AllAtendimentoPrioridade",

        "aoColumns": [
            {data: 'id_atendimento', },
            {data: 'nome_interessado'},
            {data: 'assunto'},
            {data: 'prioridade'},
            {data: 'atendimento'}
        ],
        "createdRow": function (row, data, dataIndex) {
            if (data["prioridade"] == "Emergência") {
                $(row).addClass("text-white danger");
            } else {
                $(row).addClass("text-white warning");
            }
        },
        "columnDefs": [
            {
                "render": function (data, type, row) {
                    if (row["prioridade"] == "Emergência") {
                        return  '<span  class="label label-danger">' + data + '</span>';
                        //return  '<tr class="bg-danger">' + data + '</tr>';
                        //return $(row).addClass('red');
                    } else {
                        return '<span  class="label label-warning" >' + data + '</span>';
                    }

                },
                "targets": [3]
            }
        ]
    });
}


function add_atendimento()
{
    verificaLogin();
    var titulo = 'Abertura';
    $('#info').empty();
    $('#modal_atendimento .modal-title').html('Atendimento | ' + titulo);
    $('#form_atendimento')[0].reset(); // reset form on modals
    $('#modal_atendimento').modal('show'); // show bootstrap modal
    $('#label_interessado').show();
    $('#interessado').show();
    $('#interessado').removeAttr('disabled');
    $('#cadastrar_interessado').show();
    $('#div_assunto ').attr("hidden", "true");
    $('#label_assunto').show();
    $('#assunto').show();
    $('#assunto').removeAttr('disabled');
    $('#status_atendimento').hide();
    $('#prioridade_atendimento').hide();
    //$('#btn_sair').val('Cancelar');
    $('#btn_sair').val('Cancelar');
    $('#salvar_atendimento').show();
    $('#fluxo').attr("hidden", "true");
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function salva_atendimento()
{
    $.ajax({
        url: 'funcoes/crud.php?funcao=save_atendimento',
        type: "POST",
        data: $('#form_atendimento').serialize(),
        //dataType: "JSON",
        success: function (data) {
            var x = jQuery.parseJSON(data);
            if (x.status === true) {
                console.log('Deu certo');
                $("#resultado").html(x.mensagem);
                var id_atendimento = x.id_atendimento;
                var titulo = 'Procedimentos realizados';
                $('#modal_atendimento').modal('hide');
                oTable.ajax.reload();
                $('#modal_atendimento .modal-title').html('Atendimento | ' + titulo);
                $('#cadastrar_interessado').hide();
                $('#salvar_atendimento').hide();
                $('#label_interessado').hide();
                $('#interessado').attr('disabled', 'disabled');
                $('#label_assunto').hide();
                $('#assunto').attr('disabled', 'disabled');
                $('#fluxo').removeAttr("hidden");
                $('#salva_procedimento').attr('onclick', 'salva_procedimento(' + id_atendimento + ')');
                //if success close modal and reload ajax table
                //$('#modal_atendimento').modal('hide');
                //location.reload();// for reload a page
            } else {
                //$('#errolog').show(); //Informa o erro
                console.log('Não deu certo');
                $("#resultado").html(x.mensagem);
                alert(x.mensagem);
                //location.href = 'login.php';
            }

        }
    });
}

function salva_procedimento(id_atendimento) {
    var procedimento = jQuery("#textoProcedimento").val();
    $.ajax({
        url: "funcoes/crud.php?funcao=save_procedimento",
        method: "post",
        data: {id_atendimento: id_atendimento, procedimento: procedimento},
        dataType: "json",
        complete: function (response)
        {
            //alert(response.responseText);
            $("#textoProcedimento").val("");
            all_procedimento(id_atendimento)
        }
    });
}
function novo_assunto(){
    $("#lista_assunto").empty();
    $('#div_assunto ').removeAttr("hidden");
}
function get_atendimento(id_atendimento) {
//$('#modal_atendimento').attr('style',';z-index:10000');
//$('#modal_atendimento').removeAttr('style');
//$('#modal_atendimento').css(';z-index', '10000');
//$('#modal_prioridade').removeAttr('style',';z-index: 10000');
//$('#modal_prioridade').css('z-index', - 1);
    $("#lista_assunto").empty();
    
    var titulo = 'Procedimentos realizados';
    $.ajax({
        url: 'funcoes/crud.php?funcao=get_atendimento',
        method: "POST",
        data: {id_atendimento: id_atendimento},
        dataType: "JSON",
        success: function (data, status)
        {

            $('#modal_atendimento')
                    .modal({show: true})
                    .css({
                        width: 'auto', //probably not needed
                        height: 'auto', //probably not needed 
                        'max-height': '100%'
                    });
            var nome = data[0].interessado;
            var id_interessado = data[0].id_interessado;
            var assunto = data[0].assunto;
            $('#interessado').val(data[0].interessado);
            $('#cadastrar_interessado').hide();
            $('#assunto').val(data[0].assunto);
            $('#modal_atendimento .modal-title').html('Atendimento | ' + titulo);
            $('#info').empty();
            $('#info').append('<br><div><b>Interessado:</b> ' + nome
                    + ' <a class="btn btn-primary btn-sm" type="button"'
                    + 'onclick="view_interessado(' + id_interessado + ')">'
                    + '<i class="fa fa-picture-o"></i> Vizualizar Cadastro</a>'
                    + '<br><b>Assunto:</b> ' + assunto + '</div>');
            $('#label_interessado').hide();
            $('#interessado').hide();
            $('#label_assunto').hide();
            $('#assunto').hide();
            $('#fluxo').removeAttr("hidden");
            $('#salvar_atendimento').hide();
            $('#status_atendimento').show();
            $('#btn_sair').val('Sair');
            $('#salva_procedimento').attr('onclick', 'salva_procedimento(' + id_atendimento + ')');
            $('#finaliza_atendimento').attr('onclick', 'finalizaAtendimento(' + id_atendimento + ')');
            $('#status_atendimento').attr('onclick', 'statusAtendimento(' + id_atendimento + ')');
            $('#prioridade_atendimento')
                    .text("Priorizar Atendimento e Sair")
                    .attr({title: "Priorizar Atendimento", class: "btn btn-info"})
                    .show()
                    .attr('onclick', 'priorizarAtendimento(' + id_atendimento + ')');
            all_procedimento(id_atendimento);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function all_procedimento(id_atendimento) {
    $.ajax({
        url: "funcoes/crud.php?funcao=all_procedimento",
        method: "post",
        data: {id_atendimento: id_atendimento},
        dataType: "json",
        success: function (data)
        {
            if (data === 0) {
                $("#procedimento").html("Sem procedimentos");
            } else {
                $("#procedimento").html("");
                $.each(data.procedimentos, function (i, dat) {
                    $("#procedimento").append(
                            '<div class="panel panel-info">' +
                            '<div class="panel-heading"><strong class="primary-font">' + dat.nome + '</strong>' +
                            '<small class="text-muted">' +
                            '<i class="fa fa-clock-o fa-fw"></i>' + dat.data_registro +
                            '</small>' +
                            '</div>' +
                            '<div class="panel-body">' + dat.procedimento + '</div>' +
                            '</div>'
                            );
                });
            }

        }
    });
}
function finalizaAtendimento(id_atendimento) {
    ({
        message: "<h2>Esta ação irá finalizar e arquivar o atendimento.<br>\n\
                  Deseja realmente realizar esta operação?</h2>",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            opcao = result;
            if (result === true)
            {
                $.ajax({
                    url: 'funcoes/crud.php?funcao=finaliza_atendimento',
                    method: "post",
                    data: {id_atendimento: id_atendimento},
                    dataType: "json",
                    success: function (data)
                    {

                        //$('#modal_atendimento').hide();
                        oTable.ajax.reload();
                        $('#modal_atendimento').modal('hide');
                        //showAlert(containerId, alertType, message);
                        showAlert('mensagem', 'success', 'Atendimento finalizado e arquivado com sucesso');
                        //alert(data.mensagem);

                        //dataTable_comissao.ajax.reload();

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                    }
                });
            }

            console.log('This was logged in the callback: ' + result);
        }
    });
}

function statusAtendimento(id_atendimento) {
    var status = $("#status_atendimento").attr("data-status");
    if (status === 'finaliza') {
        console.log(status);
        var mensagem = '<h2>Esta ação irá finalizar e arquivar o atendimento.<br>\n\
                  Deseja realmente realizar esta operação?</h2>';
        var funcao = 'finaliza_atendimento';
        var mensagem_sucesso = 'Atendimento finalizado e arquivado com sucesso';
    } else {
        console.log(status);
        var mensagem = '<h2>Esta ação irá reativar e desarquivar o atendimento.<br>\n\
                  Deseja realmente realizar esta operação?</h2>';
        var funcao = 'reativa_atendimento';
        var mensagem_sucesso = 'Atendimento reativado e desarquivado com sucesso';
    }

    bootbox.confirm({
        message: mensagem,
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            opcao = result;
            if (result === true)
            {
                $.ajax({
                    url: 'funcoes/crud.php?funcao=' + funcao,
                    method: "post",
                    data: {id_atendimento: id_atendimento},
                    dataType: "json",
                    success: function (data)
                    {

                        //$('#modal_atendimento').hide();
                        oTable.ajax.reload();
                        $('#modal_atendimento').modal('hide');
                        //showAlert(containerId, alertType, message);
                        showAlert('mensagem', 'success', mensagem_sucesso);
                        //alert(data.mensagem);

                        //dataTable_comissao.ajax.reload();

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                    }
                });
            }
            console.log('This was logged in the callback: ' + result);
        }
    });
}

function priorizarAtendimento(id_atendimento) {
    $('#modal_atendimento').modal('hide');
    bootbox.prompt({
        title: "Selecione a prioridade do atendimento!",
        inputType: 'select',
        inputOptions: [
            {
                text: 'Escolha a prioridade ...',
                value: '',
            },
            {
                text: 'Baixa',
                value: 'Baixa',
            },
            {
                text: 'Normal',
                value: 'Normal',
            },
            {
                text: 'Alta',
                value: 'Alta',
            },
            {
                text: 'Emergência',
                value: 'Emergência',
            }
        ],
        callback: function (result) {
            opcao = result;
            $.ajax({
                url: 'funcoes/crud.php?funcao=priorizarAtendimento&prioridade=' + opcao,
                method: "post",
                data: {id_atendimento: id_atendimento},
                dataType: "json",
                success: function (data)
                {
                    //$('#modal_atendimento').hide();
                    tabela_prioridade();
                    contaAtendimentoPrioridade();
                    //showAlert(containerId, alertType, message);
                    showAlert('mensagem', 'success', mensagem_sucesso);
                    //alert(data.mensagem);

                    //dataTable_comissao.ajax.reload();

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
            console.log('This was logged in the callback: ' + result);
        }
    });
}
function showAlert(containerId, alertType, message) {
    $("#" + containerId).append('<div class="alert alert-' + alertType + '" id="alert' + containerId + '">' + message + '</div>');
    $("#alert" + containerId).alert();
    window.setTimeout(function () {
        $("#alert" + containerId).alert('close');
    }, 2000);
}


function goLogin() {
    validaLogin($("#username"), $("#password"));
}

function validaLogin(login, senha) {
    if (login.val() == "") {
        alert("Informe o login!"); //Exibe um alerta 
        login.focus(); //Adiciona foco ao campo login usando um ponteiro
        return; //retorna nulo
    } else if (senha.val() == "") {
        alert("Informe a senha!");
        senha.focus();
        return;
    }
//Se o usuário informou login e senha, então é hora do Ajax entrar em ação
    else {
//Adicionamos um texto na DIV #resultado para alertar o usuário que o sistema está autenticando os dados
        $("#resultado").html("Autenticando...");
        /**Função ajax nativa da jQuery, onde passamos como parâmetro o endereço do arquivo que queremos chamar, 
         os dados que irá receber, e criamos de forma encadeada a função que irá armazenar o que foi retornado pelo servidor,
         para poder se trabalhar com o mesmo */
        $.ajax({//Função AJAX
            url: "funcoes/crud.php?funcao=goLogin", //Arquivo php
            type: "post", //Método de envio
            data: {username: login.val(), password: senha.val()}, //Dados
            success: function (response) {
                var x = jQuery.parseJSON(response);
                //var status = x.status;
                //console.log('status: '+status);
                //console.log(response);

                if (x.status == true) {
                    console.log('Deu certo');
                    $("#resultado").html(x.mensagem);
                    location.href = 'index.php'; //Redireciona
                } else {
                    //$('#errolog').show(); //Informa o erro
                    console.log('Não deu certo');
                    $("#resultado").html(x.mensagem);
                    //location.href = 'login.php';
                }
            }
        });
    }

}

function goLogout() {
    $.ajax({//Função AJAX
        url: "funcoes/crud.php?funcao=goLogout", //Arquivo php
        type: "post", //Método de envio
        //data: {username: login.val(), password: senha.val()}, //Dados
        success: function (retorno) {
            $("#resultado").html(retorno);
            location.href = 'login.php'; //Sucesso no AJAX
        }
    });
}

function verificaLogin() {
    $.ajax({//Função AJAX
        url: "funcoes/funcoes.php?funcao=verificaLogin", //Arquivo php
        type: "post", //Método de envio
        //data: {username: login.val(), password: senha.val()}, //Dados
        success: function (response) {
            console.log(response);
            //$("#resultado").html(retorno);
            //location.href = 'login.php';//Sucesso no AJAX
        }
    });
}

var check_session;
function CheckForSession() {

    var str = "chklogout=true";
    jQuery.ajax({
        type: "POST",
        url: "funcoes/verifica_session.php",
        data: str,
        cache: false,
        success: function (response) {
            var x = jQuery.parseJSON(response);
            if (x.status == false) {
                location.href = 'login.php'; //Sucesso no AJAX
            }
        }
    });
}
check_session = setInterval(CheckForSession, 20000);
function cadastrar_interessado()
{
    verificaLogin();
    var titulo = 'Cadastro de Interessados';
    $('#modal_interessado .info').empty();
    $('#modal_interessado .modal-title').html('Atendimento | ' + titulo);
    $('#form_interessado')[0].reset(); // reset form on modals    
    $('#modal_interessado').modal('show'); // show bootstrap modal 

    //$('#modal_interessado .modal-body').text('incluir nome, matricula, email, fone_residencial, fone_celular, categoria, curso'); // Set Title to Bootstrap modal title
}

function cadastrar_interessado()
{
    verificaLogin();
    var titulo = 'Cadastro de Interessados';
    $('#modal_interessado .info').empty();
    $('#modal_interessado .modal-title').html('Atendimento | ' + titulo);
    $('#form_interessado')[0].reset(); // reset form on modals    
    $('#modal_interessado').modal('show'); // show bootstrap modal 

    //$('#modal_interessado .modal-body').text('incluir nome, matricula, email, fone_residencial, fone_celular, categoria, curso'); // Set Title to Bootstrap modal title
}
function salva_interessado()
{
    $.ajax({
        url: 'funcoes/crud.php?funcao=save_interessado',
        type: "POST",
        data: $('#form_interessado').serialize(),
        //dataType: "JSON",
        success: function (data) {
            var x = jQuery.parseJSON(data);
            if (x.status === true) {
                console.log('Deu certo');
                $("#info").html(x.mensagem);
                $('#modal_interessado').modal('hide');
            } else {
                console.log('Não deu certo');
                $("#info_interessado").html(x.mensagem);
                alert(x.mensagem);
            }

        }
    });
}

function view_interessado(id_interessado) {
    verificaLogin();
    var titulo = 'Cadastro de Interessados - Vizualização';
    $.ajax({
        url: 'funcoes/crud.php?funcao=get_interessado',
        method: "POST",
        data: {id_interessado: id_interessado},
        dataType: "JSON",
        success: function (data, status)
        {

            $('#modal_interessado')
                    .modal({show: true})
                    .css({
                        width: 'auto', //probably not needed
                        height: 'auto', //probably not needed 
                        'max-height': '100%'
                    });
            $('#modal_interessado .info').empty();
            $('#modal_interessado .modal-title').html('Atendimento | ' + titulo);
            $('#form_interessado')[0].reset(); // reset form on modals
            $("input[name='interessado']").val(data[0].nome).attr('disabled', 'disabled');
            $("input[name='matricula']").val(data[0].matricula).attr('disabled', 'disabled');
            $("input[name='email']").val(data[0].email).attr('disabled', 'disabled');
            $("input[name='fone_residencial']").val(data[0].fone_residencial).attr('disabled', 'disabled');
            $("input[name='fone_celular']").val(data[0].fone_celular).attr('disabled', 'disabled');
            $("input[name='categoria']").val(data[0].categoria).attr('disabled', 'disabled');
            $("input[name='curso']").val(data[0].curso).attr('disabled', 'disabled');
            $('#salvar_interessado')
                    .attr('onclick', 'edit_interessado()(' + id_interessado + ')')
                    .text("Editar")
                    .attr({title: "Editar Interessado", class: "btn btn-info"});
            ;
            //$('#modal_interessado').modal('show'); // show bootstrap modal 

            //$('#modal_interessado .modal-body').text('incluir nome, matricula, email, fone_residencial, fone_celular, categoria, curso'); // Set Title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}