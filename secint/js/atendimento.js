$(document).ready(function () {
    setInterval(CheckForSession(), 5000);
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
            {"mData": "assunto"},
            {"mData": "nome_interessado"},
            {"mData": "nome_atendente"},
            {"mData": "atendimento"}
        ]
    });
    $('#atendimento').dataTable().yadcf([
        {column_number: 0, text_data_delimiter: ",", filter_type: "auto_complete"},
        {column_number: 1, text_data_delimiter: ",", filter_type: "auto_complete"},
        {column_number: 2, text_data_delimiter: ",", filter_type: "auto_complete"}
    ]);
});

function CheckForSession() {
		var str="chksession=true";
		jQuery.ajax({
				type: "POST",
				url: "verifica_session.php",
				data: str,
				cache: false,
				success: function(res){
					if(res == "1") {
					alert('Your session has been expired!');
					}
				}
		});
}
