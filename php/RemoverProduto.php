<?php
// Conecte-se ao banco de dados
include 'BD.php'; // Ajuste o caminho conforme necessário

// Verifique se o método é DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Pega o ID da query string
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Converta para inteiro para segurança

        // Prepare a consulta SQL para remover o produto
        $query = "DELETE FROM produtos WHERE id = ?";

        // Use prepared statements para evitar SQL Injection
        if ($stmt = $banco->prepare($query)) {
            $stmt->bind_param('i', $id); // 'i' significa que o parâmetro é um inteiro

            // Execute a consulta
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Produto removido com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao remover o produto.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID do produto não especificado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método HTTP inválido.']);
}

// Feche a conexão com o banco de dados
$banco->close();
