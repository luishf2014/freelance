<?php
require_once '/xampp/htdocs/_aProjeto/teste/php/BD.php'; // Ajuste o caminho conforme necessário

// Função para limpar os dados e evitar SQL Injection
function limpar_dado($dado) {
    global $banco;
    return mysqli_real_escape_string($banco, trim($dado));
}

// Verificar se o ID do produto foi passado
if (isset($_POST['id'])) {
    $id = limpar_dado($_POST['id']);
    $nome = limpar_dado($_POST['nome']);
    $marca = limpar_dado($_POST['marca']);
    $precoAtual = str_replace(',', '.', limpar_dado($_POST['precoAtual']));
    $precoAnterior = str_replace(',', '.', limpar_dado($_POST['precoAnterior']));
    $desconto = limpar_dado($_POST['desconto']);
    $descricaoCompleta = limpar_dado($_POST['descricaoCompleta']);
    $parcelas = limpar_dado($_POST['parcelas']);
    $categoria = limpar_dado($_POST['categoria']);

    // Atualizar as informações do produto
    $query = "UPDATE produtos SET nome='$nome', marca='$marca', precoAtual='$precoAtual', precoAnterior='$precoAnterior', porcentagemDesconto='$desconto', descricaoCompleta='$descricaoCompleta', parcelas='$parcelas', categoria_id='$categoria' WHERE id='$id'";
    
    if ($banco->query($query) === TRUE) {
        echo "Produto atualizado com sucesso.<br>";
    } else {
        echo "Erro ao atualizar produto: " . $banco->error . "<br>";
    }

    // Manipular o upload de imagens
    if (!empty($_FILES['imagens']['name'][0])) {
        $totalFiles = count($_FILES['imagens']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = $_FILES['imagens']['name'][$i];
            $fileTmpName = $_FILES['imagens']['tmp_name'][$i];
            $fileError = $_FILES['imagens']['error'][$i];
            $fileSize = $_FILES['imagens']['size'][$i];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileError === 0) {
                if ($fileSize < 2000000) { // Limite de tamanho: 2MB
                    $fileDestination = 'uploads/' . uniqid('', true) . "." . $fileExt;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Atualizar ou inserir a nova imagem no banco de dados
                        $queryImage = "INSERT INTO imagens (produto_id, url_imagem) VALUES ('$id', '$fileDestination')";
                        if ($banco->query($queryImage) === TRUE) {
                            echo "Imagem enviada com sucesso.<br>";
                        } else {
                            echo "Erro ao enviar imagem: " . $banco->error . "<br>";
                        }
                    } else {
                        echo "Erro ao mover a imagem para o diretório de uploads.<br>";
                    }
                } else {
                    echo "O arquivo é muito grande.<br>";
                }
            } else {
                echo "Erro ao enviar o arquivo.<br>";
            }
        }
    }

    // Redirecionar para a lista de produtos ou outra página
    // header("Location: ListaProdutos.php");
    exit();
} else {
    echo "ID do produto não fornecido.";
}
?>
