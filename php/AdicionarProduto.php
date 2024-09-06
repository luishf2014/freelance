<?php
include 'BD.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar e validar dados
    $nome = $banco->real_escape_string(trim($_POST['nome']));
    $marca = $banco->real_escape_string(trim($_POST['marca']));
    $precoAtual = floatval($_POST['precoAtual']);
    $precoAnterior = isset($_POST['precoAnterior']) ? floatval($_POST['precoAnterior']) : null;
    $porcentagemDesconto = isset($_POST['porcentagem']) ? floatval($_POST['porcentagem']) : null;
    $descricaoCompleta = $banco->real_escape_string(trim($_POST['descricaoCompleta']));
    $parcelas = intval($_POST['parcelas']);
    $categoria_id = intval($_POST['categoria_id']);

    // Validações adicionais
    if($precoAtual <= 0 ){
        die("Preço atual deve ser um valor positivo.");
    }
    if ($precoAnterior != null && $precoAnterior <= 0) {
        die("Preço deve ser um valor positivo.");
    }
    if ($categoria_id <= 0) {
        die("Categoria inválida.");
    }
    if ($porcentagemDesconto < 0 || $porcentagemDesconto > 100) {
        die("Porcentagem de desconto deve estar entre 0 e 100.");
    }

    // Preparar a declaração SQL
    $stmt = $banco->prepare("INSERT INTO produtos (nome, marca, precoAtual, precoAnterior, porcentagemDesconto, descricaoCompleta, parcelas, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdddssi', $nome, $marca, $precoAtual, $precoAnterior, $porcentagemDesconto, $descricaoCompleta, $parcelas, $categoria_id);

    // Executar a declaração
    if ($stmt->execute()) {
        $produto_id = $banco->insert_id;

        // Processar imagens
        $target_dir = "UploadsImagensCards/";
        $uploaded_files = $_FILES['imagens'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        foreach ($uploaded_files['tmp_name'] as $key => $tmp_name) {
            if (!in_array($uploaded_files['type'][$key], $allowedTypes)) {
                die("Tipo de arquivo não permitido.");
            }
            if ($uploaded_files['size'][$key] > 5 * 1024 * 1024) {
                die("O arquivo é muito grande.");
            }

            $target_file = $target_dir . basename($uploaded_files['name'][$key]);
            if (move_uploaded_file($tmp_name, $target_file)) {
                $url_imagem = $target_file;
                $stmt_imagem = $banco->prepare("INSERT INTO imagens (produto_id, url_imagem) VALUES (?, ?)");
                $stmt_imagem->bind_param('is', $produto_id, $url_imagem);
                $stmt_imagem->execute();
            }
        }

        $response['status'] = 'success';
        $response['message'] = 'Produto adicionado com sucesso';
    } else {
        $response['message'] = 'Erro: ' . $stmt->error;
    }

    $stmt->close();
}
$banco->close();
header('Content-type : application/json');
echo json_encode($response);
?>
