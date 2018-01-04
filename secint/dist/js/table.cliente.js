
/*
 * Editor client script for DB table cliente
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: 'php/cliente.php',
		table: '#cliente',
		fields: [
			{
				"label": "nome:",
				"name": "nome"
			},
			{
				"label": "curso:",
				"name": "curso"
			},
			{
				"label": "telefone:",
				"name": "telefone"
			},
			{
				"label": "email:",
				"name": "email"
			}
		]
	} );

	var table = $('#cliente').DataTable( {
		dom: 'Bfrtip',
		ajax: 'php/cliente.php',
		columns: [
			{
				"data": "nome"
			},
			{
				"data": "curso"
			},
			{
				"data": "telefone"
			},
			{
				"data": "email"
			}
		],
		select: true,
		lengthChange: false,
		buttons: [
			{ extend: 'create', editor: editor },
			{ extend: 'edit',   editor: editor },
			{ extend: 'remove', editor: editor }
		]
	} );
} );

}(jQuery));

