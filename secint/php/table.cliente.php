<?php

/*
 * Editor server script for DB table cliente
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
$db->sql( "CREATE TABLE IF NOT EXISTS `cliente` (
	`id_cliente` int(10) NOT NULL auto_increment,
	`nome` varchar(255),
	`curso` varchar(255),
	`telefone` varchar(255),
	`email` varchar(255),
	PRIMARY KEY( `id_cliente` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'cliente', 'id_cliente' )
	->fields(
		Field::inst( 'nome' ),
		Field::inst( 'curso' ),
		Field::inst( 'telefone' ),
		Field::inst( 'email' )
	)
	->process( $_POST )
	->json();
