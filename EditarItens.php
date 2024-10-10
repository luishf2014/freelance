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
    require_once 'php/BD.php'; // Ajuste o caminho conforme necessário

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
            <form id="editForm" action="php/AtualizarProduto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="produto_id" name="produto_id" value="<?php echo $product['id']; ?>">

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

                <label for="parcelas">Parcelas:</label>
                <select name="parcelas" id="parcelas" required>
                    <option value="" disabled>Selecione quantas parcelas você vai disponibilizar sem juros</option>
                    <option value="1" <?php echo ($product['parcelas'] == '1') ? 'selected' : ''; ?>>1x</option>
                    <option value="2" <?php echo ($product['parcelas'] == '2') ? 'selected' : ''; ?>>2x</option>
                    <option value="3" <?php echo ($product['parcelas'] == '3') ? 'selected' : ''; ?>>3x</option>
                    <option value="4" <?php echo ($product['parcelas'] == '4') ? 'selected' : ''; ?>>4x</option>
                    <option value="5" <?php echo ($product['parcelas'] == '5') ? 'selected' : ''; ?>>5x</option>
                    <option value="6" <?php echo ($product['parcelas'] == '6') ? 'selected' : ''; ?>>6x</option>
                    <option value="7" <?php echo ($product['parcelas'] == '7') ? 'selected' : ''; ?>>7x</option>
                    <option value="8" <?php echo ($product['parcelas'] == '8') ? 'selected' : ''; ?>>8x</option>
                    <option value="9" <?php echo ($product['parcelas'] == '9') ? 'selected' : ''; ?>>9x</option>
                    <option value="10" <?php echo ($product['parcelas'] == '10') ? 'selected' : ''; ?>>10x</option>
                    <option value="11" <?php echo ($product['parcelas'] == '11') ? 'selected' : ''; ?>>11x</option>
                    <option value="12" <?php echo ($product['parcelas'] == '12') ? 'selected' : ''; ?>>12x</option>
                </select>




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
                        $image_url = $caminhoBase . $img['url_imagem'];
                        $image_id = $img['id']; // ID da imagem para o campo oculto
                    ?>

                        <div class="field-group">
                            <label for="<?php echo $input_id; ?>">Imagem <?php echo $imageIndex; ?>:</label>
                            <div class="image-preview">
                                <img src="<?php echo $image_url; ?>" alt="Imagem <?php echo $imageIndex; ?>" id="<?php echo $preview_id; ?>">
                            </div>
                            <input type="hidden" name="imagem_id<?php echo $imageIndex; ?>" value="<?php echo $image_id; ?>">
                            <input type="file" id="<?php echo $input_id; ?>" name="imagem<?php echo $imageIndex; ?>" accept="image/*" onchange="previewImage('<?php echo $input_id; ?>', '<?php echo $preview_id; ?>')">
                        </div>

                    <?php
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
    <script>
        // Script para atualizar o preview das imagens
        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            var preview = document.getElementById(previewId);

            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Função para calcular a porcentagem de desconto
        function calcularDesconto() {
            var precoAtual = parseFloat(document.getElementById('precoAtual').value);
            var precoAnterior = parseFloat(document.getElementById('precoAnterior').value);
            var porcentagem = document.getElementById('porcentagem');

            if (!isNaN(precoAtual) && !isNaN(precoAnterior) && precoAnterior > 0) {
                var desconto = ((precoAnterior - precoAtual) / precoAnterior) * 100;
                porcentagem.value = desconto.toFixed(0) + '%';
            } else {
                porcentagem.value = '';
            }
        }


        /* mensagem */
        // Função para mostrar o toast
        function showToast(message, type) {
            var toast = document.getElementById('toast');
            var toastMessage = document.getElementById('toast-message');
            var toastIcon = document.getElementById('toast-icon');

            toastMessage.textContent = message;
            toast.className = 'toast show ' + type;

            // Ocultar o toast após 3 segundos
            setTimeout(function() {
                toast.className = 'toast hidden ' + type;
                setTimeout(function() {
                    window.location.href = '../teste/ListaEditar.php';
                }, 100);
            }, 3000);
        }

        // Exemplo de como usar a função showToast
        // Quando o formulário for enviado
        document.querySelector('#editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Previne o envio do formulário

            var formData = new FormData(this);
            fetch('php/AtualizarProduto.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    // Mostrar a mensagem de sucesso
                    showToast('Produto editado com sucesso! 🚀', 'success');


                })
                .catch(error => {
                    // Mostrar a mensagem de erro
                    showToast('Erro ao editar o produto. Tente novamente. ', 'error');
                });
        });
    </script>
</body>

</html>