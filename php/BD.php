<?php
$banco = new mysqli("localhost", "root", "Fonseca132171", "camisa10", 3306);
// echo "Teste Banco de dados"; //para debug
if ($banco->connect_error) {
    die("Connection failed: " . $banco->connect_error);
}
?>

