function GetCandidatoDelegar(id_candidato) {
    $("input[name=hidden_id_candidato]").val(id_candidato);    
    $.ajax({
        type: 'post',
        url: 'crud_avaliacao.php?funcao=GetCandidatoDelegar',
        data: {id_candidato: id_candidato},
        dataType: 'json',
        success: function (data1) {
            $.each(data1, function (idx, obj) {
                //alert(obj.nome);
                //var teste = 'teste de variavel';
                var nome = obj.nome;
                $('input#candidato').val(nome);
            });
        }
    });

    // Open modal popup
    $("#delegar_modal").modal("show");
}

function DelegarCandidato() {
    var new_avaliador = $("select[name=novo_avaliador]").val();
    var id_candidato = $("input[name=hidden_id_candidato]").val();
    var motivo = $("input#motivo").val();
    $.ajax({
        type: 'post',
        url: 'crud_avaliacao.php?funcao=DelegarCandidato',
        data: {id_candidato: id_candidato,
            new_avaliador: new_avaliador,
            motivo: motivo},
        dataType: 'json',
        success: function (data2) {

        }
    });
    $("#delegar_modal").modal("hide");
}

function GetCandidatoAvaliar(id_candidato) {
    $("input[name=hidden_id_candidato]").val(id_candidato);
    $.ajax({
        type: 'post',
        url: 'crud_avaliacao.php?funcao=GetCandidatoAvaliar',
        data: {id_candidato: id_candidato},
        dataType: 'json',
        success: function (data3) {
            //console.log(data);
            console.log( "A button with the alert class was clicked!" );
            
            $.each(data3, function (idx, obj) {  
                $("input[name=hidden_nome]").val(obj.id_identificacao);
                $("p#nome").text('Nome: '+obj.nome_candidato);                
                $("p#linha_pesquisa_1").text('Linha de Pesquisa 1: '+obj.linha_pesquisa_1);
                $("p#linha_pesquisa_2").text('Linha de Pesquisa 2: '+obj.linha_pesquisa_2);
                $("p#orientador_1").text('Orientador 1: '+obj.orientador_1);
                $("p#orientador_2").text('Orientador 2: '+obj.orientador_2);
                $("p#orientador_3").text('Orientador 3: '+obj.orientador_3);
                $("p#poscomp").text("Poscomp: "+obj.poscomp);
                $("p#bolsa").text('Bolsa: '+obj.bolsa);                
            });            
        }
    });

    // Open modal popup
    $("#avaliar_modal").modal("show");
}

function formIdentificacao(id_candidato) {
    
    

    // Open modal popup
    $("#formIdentificacao").modal("show");
}

function loadModal(id,url){
    $('#' + id).on('show.bs.modal', function () {
        $(this).load(url);
    });
}