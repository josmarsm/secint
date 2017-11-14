<?php
// Verifica se algo foi postado
if ( ! empty( $_POST ) ) {
 // <input type="text" name="nome">
 echo 'Nome: ' . $_POST['nome'] . '<br>';
 
 // <input type="email" name="email">
 echo 'Email: ' . $_POST['email'] . '<br>';
 
 // <input type="text" name="telefone">
 echo 'Telefone: ' . $_POST['telefone'] . '<br>';
 
 // <input type="text" name="endereco">
 echo 'Endereço: ' . $_POST['endereco'] . '<br>';
}
?>