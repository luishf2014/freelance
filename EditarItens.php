<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            width: 100%;
            background: white;
        }

        .logo-imagem {
            border-radius: 50px;
            background-size: contain;
        }

        .container-logo {
            display: flex;
            align-items: center;
        }

        .menu li {
            display: inline-block;
            margin: 0 10px;
        }

        .menu li a {
            font-family: "Grenze", serif;
            font-weight: 300;
            font-size: 23px;
            letter-spacing: 1px;
            text-decoration: none;
            color: white;
            background-color: black;
            text-transform: uppercase;
            padding: 5px 20px;
            border-radius: 100px;
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 1s ease;
        }

        .menu li a:hover {
            color: black;
            background-color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        .main {
            width: 1000px;
        }

        .form-container {
            max-width: 900px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 1em;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px);
        }

        .hidden {
            display: none;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1em;
            color: #333;
            cursor: pointer;
        }

        .checkbox-label input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .field-group {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .image-preview img {
            object-fit: cover;
            max-width: 200px;
            max-height: 200px;
            border-radius: 5px;
        }

        .toast {
            position: fixed;
            left: 50%;
            top: 85%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 16px;
            border-radius: 8px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            display: none;
        }

        .toast.show {
            display: block;
            opacity: 1;
        }

        .toast.hidden {
            opacity: 0;
            display: none;
        }

        .toast.success {
            background-color: #4CAF50;
        }

        .toast.error {
            background-color: #F44336;
        }

        .toast-icon {
            margin-right: 8px;
            vertical-align: middle;
        }

        .toast-message {
            display: inline;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <header>
        <div class="container-logo">
            <div><a href="home.html"><img src="../teste/Uploads/logoMenor.png" alt="marca" class="logo-imagem"></a></div>
        </div>
        <nav class="menu">
            <ul class="ul-mobile">
                <li><a href="adm.html">Painel</a></li>
                <li><a href="AdicionarItens.php">Adicionar</a></li>
                <li><a href="ListaEditar.php">Ver Produtos</a></li>
            </ul>
        </nav>
    </header>
    <?php
    require_once '/xampp/htdocs/_aProjeto/teste/php/BD.php'; // Ajuste o caminho conforme necessário

    $id = $_GET['id'];

    // Busque o produto
    $query = "SELECT p.id, p.nome, p.marca, p.precoAtual, p.precoAnterior, p.porcentagemDesconto, p.descricaoCompleta, p.parcelas, p.categoria_id, c.nome AS categoria_nome
    FROM produtos p
    JOIN categorias c ON p.categoria_id = c.id
    WHERE p.id = ?";
    $stmt = $banco->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>Produto não encontrado.</p>";
        exit;
    }
    ?>
    <main class="main">
        <div class="form-container">
            <h1>Editar Produto</h1>
            <form id="editForm" action="AtualizarProduto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="produtoId" name="produtoId" value="<?php echo $product['id']; ?>">

                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria_id" required>
                    <?php
                    // Busque categorias
                    $cat_query = "SELECT id, nome FROM categorias";
                    $cat_result = $banco->query($cat_query);

                    while ($cat = $cat_result->fetch_assoc()) {
                        $selected = ($cat['id'] == $product['categoria_id']) ? 'selected' : '';
                        echo "<option value='{$cat['id']}' $selected>{$cat['nome']}</option>";
                    }
                    ?>
                </select>

                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?php echo htmlspecialchars($product['nome']); ?>" required>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" placeholder="Digite a marca do produto" value="<?php echo htmlspecialchars($product['marca']); ?>" required>

                <label for="precoAtual">Preço Atual:</label>
                <input type="number" id="precoAtual" name="precoAtual" placeholder="Digite o preço atual" value="<?php echo htmlspecialchars($product['precoAtual']); ?>" step="0.01" oninput="calcularDesconto()" required>

                <label for="precoAnterior">Preço Anterior:</label>
                <input type="number" id="precoAnterior" name="precoAnterior" placeholder="Digite o preço anterior" value="<?php echo htmlspecialchars($product['precoAnterior']); ?>" step="0.01" oninput="calcularDesconto()">

                <label for="porcentagem">Porcentagem de Desconto:</label>
                <input type="text" id="porcentagem" name="porcentagem" placeholder="Desconto (%)" value="<?php echo htmlspecialchars($product['porcentagemDesconto']); ?>" readonly>

                <label for="descricaoCompleta">Descrição Completa:</label>
                <textarea id="descricaoCompleta" name="descricaoCompleta" rows="4" placeholder="Digite a descrição completa" required><?php echo htmlspecialchars($product['descricaoCompleta']); ?></textarea>

                <label for="parcelas">Número de Parcelas:</label>
                <input type="number" id="parcelas" name="parcelas" placeholder="Número de parcelas" value="<?php echo htmlspecialchars($product['parcelas']); ?>" required>


                <div class="image-upload">
                    <?php
                    // Defina a URL base
                    $caminhoBase = "http://localhost/_aProjeto/teste/php/";

                    // Exibir imagens atuais
                    $images_query = "SELECT id, url_imagem FROM imagens WHERE produto_id = ?";
                    $stmt = $banco->prepare($images_query);
                    $stmt->bind_param("i", $product['id']);
                    $stmt->execute();
                    $images_result = $stmt->get_result();

                    $imageIndex = 1; // Índice para numerar os campos de imagem
                    while ($img = $images_result->fetch_assoc()) {
                        $input_id = "imagem" . $imageIndex;
                        $preview_id = "preview-imagem" . $imageIndex;
                        $image_url = $img['url_imagem'];
                        $image_id = $img['id']; // ID da imagem para o campo oculto

                        // Construa o caminho completo da imagem
                        $full_image_url = $caminhoBase . $image_url;

                        echo "<div class='image-preview'>";
                        echo "<label for='$input_id'>Imagem $imageIndex:</label>";

                        // Verifica e exibe a imagem atual
                        if (!empty($image_url)) {
                            echo "<img id='$preview_id' src='$full_image_url' style='max-width: 200px; max-height: 200px;' alt='Imagem do produto'>";
                        } else {
                            // Mensagem quando não há imagem
                            echo "<div id='$preview_id' style='max-width: 50px; max-height: 50px; line-height: 200px; text-align: center; border: 1px solid #ddd; color: #666;'>Sem imagem</div>";
                        }

                        echo "<input type='file' id='$input_id' name='imagens[]' accept='image/*'>";
                        echo "<input type='hidden' name='imagem_ids[]' value='$image_id'>"; // Adiciona um campo oculto para o ID da imagem
                        echo "</div>";

                        $imageIndex++;
                    }

                    // Adiciona campos adicionais se necessário
                    while ($imageIndex <= 4) {
                        $input_id = "imagem" . $imageIndex;
                        $preview_id = "preview-imagem" . $imageIndex;
                        echo "<div class='image-preview'>";
                        echo "<label for='$input_id'>Imagem $imageIndex:</label>";
                        echo "<div id='$preview_id' style='max-width: 200px; max-height: 200px; line-height: 200px; text-align: center; border: 1px solid #ddd; color: #666;'>Sem imagem</div>";
                        echo "<input type='file' id='$input_id' name='imagens[]' accept='image/*'>";
                        echo "</div>";
                        $imageIndex++;
                    }
                    ?>
                </div>

                <button type="submit">Atualizar Produto</button>

                <!-- Toast Notification -->
                <div id="toast" class="toast">
                    <span id="toast-icon" class="toast-icon"></span>
                    <span id="toast-message" class="toast-message"></span>
                </div>
            </form>
        </div>
    </main>

    <div id="toast" class="toast"></div>

    <script>
        // Script para atualizar o preview das imagens
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', event => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const previewImg = document.querySelector(`#preview-${event.target.id}`);
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Função de cálculo de desconto
        function calcularDesconto() {
            const precoAtual = parseFloat(document.getElementById('precoAtual').value);
            const precoAnterior = parseFloat(document.getElementById('precoAnterior').value);

            if (precoAtual && precoAnterior && precoAtual < precoAnterior) {
                const desconto = ((precoAnterior - precoAtual) / precoAnterior) * 100;
                document.getElementById('porcentagem').value = `${desconto.toFixed(2)}%`;
            } else {
                document.getElementById('porcentagem').value = '';
            }
        }

        // Função de exibição de toast
        function showToast(message, type) {
            const toast = document.getElementById('toast');
            toast.className = `toast ${type} show`;
            toast.textContent = message;
            setTimeout(() => {
                toast.className = `toast ${type} hidden`;
            }, 30000);
        }
    </script>
</body>

</html>