<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
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
            width: 200%;
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
            /* width: 100%; */
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

        .image-upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        .image-upload input[type="file"] {
            padding: 0;
        }

        /* mensagem */
        /* Estilo do toast */
        .toast {
            position: fixed;
            left: 50%;
            top: 85%;
            /* bottom: 20px; */
            /* Distância do fundo da página */
            transform: translateX(-50%);
            /* Centraliza horizontalmente */
            background-color: #333;
            color: #fff;
            padding: 16px;
            border-radius: 8px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            /* Adiciona transição */
            display: none;
            /* Inicialmente escondido */
        }

        /* Toast visível */
        .toast.show {
            display: block;
            /* Torna o toast visível */
            opacity: 1;
        }

        /* Toast oculto */
        .toast.hidden {
            opacity: 0;
            display: none;
            /* Esconde o toast */
        }

        /* Ícone de sucesso */
        .toast.success {
            background-color: #4CAF50;
        }

        /* Ícone de erro */
        .toast.error {
            background-color: #F44336;
        }

        /* Estilo do ícone */
        .toast-icon {
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Mensagem do toast */
        .toast-message {
            display: inline;
            vertical-align: middle;
        }

        #descricaoCompleta {
            resize: vertical;
            /* Permite redimensionar apenas na vertical */
            width: 100%;
            /* Adapta a largura ao container pai */
        }

        #descricaoCompleta {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            font-family: Arial, sans-serif;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
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
                <li><a href="ListaEditar.php">Ver Produtos</a></li>

            </ul>
        </nav>
    </header>
    <?php
    require_once 'php/getCategoria.php';
    ?>
    <main class="main">

        <div class="form-container">
            <h1>Adicionar Novo Produto</h1>
            <form action="php/AdicionarProduto.php" method="POST" enctype="multipart/form-data">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria_id" required>
                    <option value="" disabled selected>Selecione a categoria do produto</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo htmlspecialchars($categoria['nome']); ?></option>
                    <?php endforeach; ?>
                </select>


                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" placeholder="Digite a marca do produto" required>

                <label for="precoAtual">Preço Atual:</label>
                <input type="number" id="precoAtual" name="precoAtual" placeholder="Digite o novo preço do produto"
                    step="0.01" min="0" required>

                <div class="form-group form-check" style="display: flex; align-items: center;">
                    <label class="checkbox-label" for="temDesconto" style="margin-right: 10px;">
                        O produto tem desconto?
                    </label>
                    <input type="checkbox" class="form-check-input" id="temDesconto" name="temDesconto"
                        onclick="toggleDesconto()">
                </div>

                <div id="precoAnteriorField" class="field-group hidden">
                    <label for="precoAnterior">Preço Anterior:</label>
                    <input type="number" id="precoAnterior" name="precoAnterior"
                        placeholder="Digite o antigo preço do produto" step="0.01" oninput="calcularDesconto()" style="width: 98%;">

                    <label for="porcentagem">Porcentagem de Desconto:</label>
                    <input type="text" id="porcentagem" name="porcentagem" style="width: 98%;" readonly>
                </div>

                <label for="descricaoCompleta">Descrição Completa:</label>
                <textarea id="descricaoCompleta" name="descricaoCompleta" placeholder="Digite uma descrição do produto"
                    rows="10" cols="50" required></textarea>

                <label for="parcelas">Parcelas:</label>
                <select name="parcelas" id="parcelas">
                    <!-- As opções serão preenchidas pelo backend -->
                    <option value="" disabled selected>Selecione quantas parcelas você vai disponibilizar sem juros</option>
                    <option value="1">1x</option>
                    <option value="2">2x</option>
                    <option value="3">3x</option>
                    <option value="4">4x</option>
                    <option value="5">5x</option>
                    <option value="6">6x</option>
                    <option value="7">7x</option>
                    <option value="8">8x</option>
                    <option value="9">9x</option>
                    <option value="10">10x</option>
                    <option value="11">11x</option>
                    <option value="12">12x</option>
                </select>


                <div class="image-upload">
                    <label for="imagens">Imagens do Produto:</label>
                    <input type="file" id="imagens" name="imagens[]" accept="image/*" multiple>
                    <div id="error-message" class="error-message"></div>
                </div>

                <button type="submit">Adicionar Produto</button>

                <!-- Toast Notification -->
                <div id="toast" class="toast">
                    <span id="toast-icon" class="toast-icon"></span>
                    <span id="toast-message" class="toast-message"></span>
                </div>


            </form>
        </div>
    </main>

    <script>
        // Função para mostrar/ocultar campos e calcular desconto
        function toggleDesconto() {
            var descontoCheckbox = document.getElementById('temDesconto');
            var precoAnteriorField = document.getElementById('precoAnteriorField');
            var isChecked = descontoCheckbox.checked;

            precoAnteriorField.classList.toggle('hidden', !isChecked);

            // Limpar cálculo de desconto se checkbox não estiver marcado
            if (!isChecked) {
                document.getElementById('porcentagem').value = '';
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

        /* imagens */
        document.getElementById('imagens').addEventListener('change', function(event) {
            const fileInput = event.target;
            const files = fileInput.files;
            const errorMessage = document.getElementById('error-message');

            // Limitar a 4 arquivos
            if (files.length > 4) {
                errorMessage.textContent = 'Você pode selecionar no máximo 4 imagens.';
                fileInput.value = ''; // Limpar seleção
                return;
            }

            // Verificar tipos de imagem permitidos
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            for (const file of files) {
                if (!allowedTypes.includes(file.type)) {
                    errorMessage.textContent = 'Apenas imagens JPEG, PNG e GIF são permitidas.';
                    fileInput.value = ''; // Limpar seleção
                    return;
                }
            }

            // Se tudo estiver ok
            errorMessage.textContent = '';
        });

        /* Categoria */
        document.addEventListener('DOMContentLoaded', function() {
            fetch('php/getCategoria.php')
                .then(response => response.json())
                .then(data => {
                    const categoriaSelect = document.getElementById('categoria');
                    data.forEach(categoria => {
                        const option = document.createElement('option');
                        option.value = categoria.id;
                        option.textContent = categoria.nome;
                        categoriaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar categorias:', error));
        });

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
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Previne o envio do formulário

            var formData = new FormData(this);
            fetch('php/AdicionarProduto.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    // Mostrar a mensagem de sucesso
                    showToast('Produto adicionado com sucesso! 🚀', 'success');
                })
                .catch(error => {
                    // Mostrar a mensagem de erro
                    showToast('Erro ao adicionar o produto. Tente novamente. ', 'error');
                });
        });
    </script>
</body>

</html>