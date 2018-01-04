-- 
-- Editor SQL for DB table cliente
-- Created by http://editor.datatables.net/generator
-- 

CREATE TABLE IF NOT EXISTS `cliente` (
	`id_cliente` int(10) NOT NULL auto_increment,
	`nome` varchar(255),
	`curso` varchar(255),
	`telefone` varchar(255),
	`email` varchar(255),
	PRIMARY KEY( `id_cliente` )
);