$(document).ready(function () {
    var oTable = $('#example').dataTable({
        "ordering": false,
        "bProcessing": true,
        "sAjaxSource": "interessado.php",
        "aoColumns": [
            {"mData": "nome"},
            {"mData": "nome_curso"},
            {"mData": "fone_residencial"},
            {"mData": "fone_celular"},
            {"mData": "email"},
            {"mData": "atendimento"},
            {"mData": "acoes"}
        ]
    });
    $('#example').dataTable().yadcf([
        {column_number: 0, text_data_delimiter: ",", filter_type: "auto_complete"},
        {column_number: 1}
    ]);
});

$(document).ready(function () {
    var oTable_atendimento = $('#atendimento').dataTable({
        "ordering": false,
        "bProcessing": true,
        "sAjaxSource": "atendimento.php",
        "aoColumns": [
            {"mData": "nome"},
            {"mData": "nome_curso"},
            {"mData": "fone_residencial"},
            {"mData": "fone_celular"},
            {"mData": "email"},
            {"mData": "atendimento"},
            {"mData": "acoes"}
        ]
    });
    $('#atendimento').dataTable().yadcf([
        {column_number: 0, text_data_delimiter: ",", filter_type: "auto_complete"},
        {column_number: 1}
    ]);
});