<?php
$server = $_SERVER['SERVER_NAME'];
//echo $server;
//Se a variavel $server retornar localhost

////echo $server;
//Se a variavel $server retornar localhost
if ($server == "localhost") {
    /*
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', 'Ramsoj@123');
    define('MYSQL_DB_NAME', 'selecao');
    */
    $MYSQL_HOST ='localhost';
    $MYSQL_USER = 'root';
    $MYSQL_PASSWORD = 'Ramsoj@123';
    $MYSQL_DB_NAME = 'selecao';   
    $url = "http://localhost/selecao";
} else {    
    $MYSQL_HOST='localhost';
    $MYSQL_USER='pgcc';
    $MYSQL_PASSWORD='3aXGnnkd';
    $MYSQL_DB_NAME='PGCC';    
    $url = "http://ufsm.br/pgcc/selecao";
}

define('SITE', $url);

try {
    $db = new PDO('mysql:host=' . $MYSQL_HOST . ';dbname=' . $MYSQL_DB_NAME, $MYSQL_USER, $MYSQL_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}

$db->exec("SET CHARACTER SET utf8");

