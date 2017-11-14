function loadModal(id, url) {
    $('#' + id).on('show.bs.modal', function () {
        $(this).load(url);
    });
}

function fechaModal(modal) {
    $('#' + modal).modal('hide');
}

function getIdentificacao(id_candidato) {
    var row_candidato = id_candidato;
    // Fazendo requisição AJAX
    $.post('ajax/atualizar.php', function (frase) {

        // Exibindo frase
        $('#frase').html('<i>' + frase.texto + '</i><br />' + frase.autor);

    }, 'JSON');

    $('#myModal_avaliar').modal();   //alert("cliclou em : " + id_candidato);    
    //$.get('?p=comissao',{row_candidato:row_candidato});

}


$("#myModal").on("show.bs.modal", function (e) {
    $target = {};
    var link = $(e.relatedTarget);
    ['id', 'button', 'title', 'content'].forEach(function (value, key) {
        $target[value] = $(e.relatedTarget).data(value);
    });
    $(".modal-title").text($target.title);
    $(".close-changes").text($target.button);

    $(this).find(".modal-body").load(link.attr("href"));
});

$(document).on('show', '.accordion', function (e) {
    //$('.accordion-heading i').toggleClass(' ');
    $(e.target).prev('.accordion-heading').addClass('accordion-opened');
});

$(document).on('hide', '.accordion', function (e) {
    $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
    //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
});

$(document).ready(function () {
    $(function () {
        $(".collapse.in").parents(".panel").addClass("active");
        $('a[data-toggle="collapse"]').on('click', function () {
            var objectID = $(this).attr('href');
            var expandale = $(this).attr('data-expandable');
            if (expandale == 'true') {
                if ($(objectID).hasClass('in')) {
                    $(objectID).collapse('hide');
                } else {
                    $(objectID).collapse('show');
                }
            }
            var $expandable = $(this).attr("data-expandable"),
                    $expanded = $(this).attr("aria-expanded"),
                    $current = $(this).closest('.pmd-accordion').attr("id");
            if ($expandable == "false") {
                if ($expanded == "true") {
                    //alert("not exp closed")
                    $("#" + $current + " .active").removeClass("active");
                } else {
                    //alert("not exp open")
                    $("#" + $current + " .active").removeClass("active");
                    $(this).parents('.panel').addClass("active");
                }
            }
            if ($expandable == "true") {
                if ($expanded == "true") {
                    $(this).parents('.panel').addClass("active");
                } else {
                    $(this).parents('.panel').removeClass("active");
                }
            }
        });

        // custom function for expand all and collapse all button 
        $('#expandAll').on('click', function () {
            var GetID = $(this).attr("data-target");
            $('#' + GetID + ' ' + 'a[data-toggle="collapse"]').each(function () {
                var objectID = $(this).attr('href');
                if ($(objectID).hasClass('in') === false)
                {
                    $(objectID).collapse('show');
                    $(objectID).parent().addClass("active");
                }
            });
        });

        //
        $('#collapseAll').on('click', function () {
            var GetID = $(this).attr("data-target");
            $('#' + GetID + ' ' + 'a[data-toggle="collapse"]').each(function () {
                var objectID = $(this).attr('href');
                $(objectID).collapse('hide');
                $(objectID).parent().removeClass("active");
            });
        });

    });
}
);