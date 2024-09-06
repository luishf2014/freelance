<?php
// Inclua o código de conexão com o banco de dados
include 'BD.php';

// Buscar categorias
$sql = "SELECT id, nome FROM categorias";
$result = $banco->query($sql);

$categorias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

$banco->close();
?>
