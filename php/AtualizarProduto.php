<?php
include 'BD.php';
$response = []; // Para armazenar mensagens de resposta

// Definir o cabeçalho como JSON logo no início
header('Content-Type: application/json');

// Verificar se o formulário foi enviado e o ID do produto está presente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);

    // Escapar e validar dados
    $nome = $banco->real_escape_string(trim($_POST['nome']));
    $marca = $banco->real_escape_string(trim($_POST['marca']));
    $precoAtual = floatval($_POST['precoAtual']);
    $precoAnterior = isset($_POST['precoAnterior']) ? floatval($_POST['precoAnterior']) : null;
    $porcentagemDesconto = isset($_POST['porcentagem']) ? floatval($_POST['porcentagem']) : null;
    $descricaoCompleta = $banco->real_escape_string(trim($_POST['descricaoCompleta']));
    $parcelas = $_POST['parcelas'];
    $categoria_id = intval($_POST['categoria_id']);

    // Validações adicionais
    if ($precoAtual <= 0) {
        $response['status'] = 'error';
        $response['message'] = 'Preço atual deve ser um valor positivo.';
        echo json_encode($response);
        exit();
    }
    if ($precoAnterior !== null && $precoAnterior <= 0) {
        $response['status'] = 'error';
        $response['message'] = 'Preço anterior deve ser um valor positivo.';
        echo json_encode($response);
        exit();
    }
    if ($categoria_id <= 0) {
        $response['status'] = 'error';
        $response['message'] = 'Categoria inválida.';
        echo json_encode($response);
        exit();
    }
    if ($porcentagemDesconto < 0 || $porcentagemDesconto > 100) {
        $response['status'] = 'error';
        $response['message'] = 'Porcentagem de desconto deve estar entre 0 e 100.';
        echo json_encode($response);
        exit();
    }

    // Preparar a declaração SQL para atualizar o produto
    $stmt = $banco->prepare("UPDATE produtos SET nome = ?, marca = ?, precoAtual = ?, precoAnterior = ?, porcentagemDesconto = ?, descricaoCompleta = ?, parcelas = ?, categoria_id = ? WHERE id = ?");
    $stmt->bind_param('ssdddssii', $nome, $marca, $precoAtual, $precoAnterior, $porcentagemDesconto, $descricaoCompleta, $parcelas, $categoria_id, $produto_id);

    // Executar a declaração
    if ($stmt->execute()) {
        // Atualizar imagens, se houver novas imagens enviadas
        if (isset($_FILES['imagens'])) {
            $target_dir = "UploadsImagensCards/";
            $uploaded_files = $_FILES['imagens'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            foreach ($uploaded_files['tmp_name'] as $key => $tmp_name) {
                if (!in_array($uploaded_files['type'][$key], $allowedTypes)) {
                    $response['status'] = 'error';
                    $response['message'] = 'Tipo de arquivo não permitido.';
                    echo json_encode($response);
                    exit();
                }
                if ($uploaded_files['size'][$key] > 5 * 1024 * 1024) {
                    $response['status'] = 'error';
                    $response['message'] = 'O arquivo é muito grande.';
                    echo json_encode($response);
                    exit();
                }

                $target_file = $target_dir . basename($uploaded_files['name'][$key]);
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $url_imagem = $target_file;

                    // Verificar se a imagem já existe e atualizar ou inserir nova imagem
                    $stmt_imagem = $banco->prepare("SELECT COUNT(*) FROM imagens WHERE produto_id = ? AND id = ?");
                    $stmt_imagem->bind_param('ii', $produto_id, $key);
                    $stmt_imagem->execute();
                    $stmt_imagem->bind_result($count);
                    $stmt_imagem->fetch();

                    if ($count > 0) {
                        // Atualizar imagem existente
                        $stmt_update_imagem = $banco->prepare("UPDATE imagens SET url_imagem = ? WHERE produto_id = ? AND id = ?");
                        $stmt_update_imagem->bind_param('sii', $url_imagem, $produto_id, $key);
                        $stmt_update_imagem->execute();
                    } else {
                        // Inserir nova imagem
                        $stmt_insert_imagem = $banco->prepare("INSERT INTO imagens (produto_id, url_imagem) VALUES (?, ?)");
                        $stmt_insert_imagem->bind_param('is', $produto_id, $url_imagem);
                        $stmt_insert_imagem->execute();
                    }
                }
            }
        }

        $response['status'] = 'success';
        $response['message'] = 'Produto atualizado com sucesso';
    } else {

        $response['message'] = 'Erro: ' . $stmt->error;
    }

    $stmt->close();
}

$banco->close();
echo json_encode($response);