<?php

$server = $_SERVER['SERVER_NAME'];
//echo $server;
//Se a variavel $server retornar localhost
////echo $server;
//Se a variavel $server retornar localhost
if ($server == "localhost") {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('DBNAME', 'secint');
    define('PASSWORD', 'Ramsoj@123');
    define('CHARSET', 'utf8');
    define('SITE', 'http://localhost/secint');
} else {
    define('HOST', 'localhost');
    define('USER', 'secint');
    define('DBNAME', 'SECINT');
    define('PASSWORD', 'oosee4quohWa');
    define('CHARSET', 'utf8');
    define('SITE', 'http://ufsm.br/secint/');    
}

try {
    $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
    $db = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, $opcoes);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}