<?php

// include Database connection file
include("config.php");
session_start();
$usuario = $_SESSION['id_usuario'];
//var_dump($_SESSION);
// check request
if (isset($_POST)) {
// get values
    $email = $_REQUEST['email'];
    $password_atual = $_POST['password_atual'];
    $password_new = $_POST['password_new'];
    $confirmpassword_new = $_POST['confirmpassword_new'];

    if (!empty($password_new)) {
        if ($password_new == $confirmpassword_new) {
            $query = "UPDATE usuario SET email='$email', password='$password_new' where id_usuario='$usuario'";
        } else {
            echo'As senhas não são iguais';
        }
    } else {
        $query = "UPDATE usuario SET email='$email' where id_usuario='$usuario'";
    }

    //var_dump($query);
    $statement = $db->prepare($query);
    //print_r($statement);
    $result = $statement->execute();
//$result = $statement->fetchAll();
//print_r($result);
//if (!$result = mysqli_query($con, $query)) {
//  exit(mysqli_error($con));
//}
    if (!empty($result)) {
        echo 'Dados alterados com sucesso';
    }
}