<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Remover Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        .remover-produto-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .buscar-btn {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buscar-btn:hover {
            background-color: #0056b3;
        }

        .lista-produtos {
            margin-top: 20px;
        }

        .produto-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f1f1f1;
        }

        .produto-item button {
            padding: 8px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .produto-item button:hover {
            background-color: #e53935;
        }

        /* cabeçalho */
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
    </style>
</head>

<body>
    <header>
        <div class="container-logo">
            <div><a href="home.html"><img src="../teste/Uploads/logoMenor.png" alt="marca" class="logo-imagem"></a>
            </div>
        </div>
        <nav class="menu">
            <ul class="ul-mobile">
                <li><a href="adm.html">Painel</a></li>
                <li><a href="AdicionarItens.php">Adicionar</a></li>
                <li><a href="EditarItens.php">Editar</a></li>
                <li><a href="">Ver Produtos</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        require_once '/xampp/htdocs/_aProjeto/teste/php/getCategoria.php';
        ?>
        <section class="remover-produto-section">
            <h2>Remover Produto</h2>
            <form id="form-remover-produto">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria_id" required>
                    <option value="" disabled selected>Selecione a categoria do produto</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>">
                            <?php echo htmlspecialchars($categoria['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="buscar-produto">Buscar Produto:</label>
                <input type="text" id="buscar-produto" name="buscar-produto" placeholder="Digite o Nome">


                <button type="button" class="buscar-btn" onclick="buscarProduto()">Buscar</button>
            </form>

            <div id="lista-produtos" class="lista-produtos">
                <!-- Conteúdo gerado dinamicamente -->
            </div>
        </section>
    </main>

    <script>
        // Função para buscar produtos com base no texto e na categoria selecionada
        function buscarProduto() {
            const busca = document.getElementById('buscar-produto').value;
            const categoria = document.getElementById('categoria').value;

            // Exemplo de chamada para buscar produtos - ajustar conforme o backend
            // Aqui você faria uma requisição para buscar os produtos com base no input e categoria
            fetch(`/buscarProduto?query=${busca}&categoria_id=${categoria}`)
                .then(response => response.json())
                .then(data => mostrarProdutos(data))
                .catch(error => console.error('Erro ao buscar produtos:', error));
        }

        // Função para exibir os produtos encontrados
        function mostrarProdutos(produtos) {
            const lista = document.getElementById('lista-produtos');
            lista.innerHTML = '';

            produtos.forEach(produto => {
                const produtoItem = document.createElement('div');
                produtoItem.className = 'produto-item';
                produtoItem.innerHTML = `
                    <span>${produto.nome}</span>
                    <button type="button" onclick="confirmarRemocao(${produto.id})">Remover</button>
                `;
                lista.appendChild(produtoItem);
            });
        }

        // Função para confirmar e remover o produto
        function confirmarRemocao(produtoId) {
            if (confirm('Tem certeza que deseja remover este produto?')) {
                fetch(`/removerProduto?id=${produtoId}`, {
                        method: 'DELETE'
                    })
                    .then(response => {
                        if (response.ok) {
                            alert('Produto removido com sucesso!');
                            buscarProduto(); // Atualiza a lista de produtos
                        } else {
                            alert('Erro ao remover o produto.');
                        }
                    })
                    .catch(error => console.error('Erro ao remover produto:', error));
            }
        }

        // Função para preencher as opções do select de categorias com dados do backend
        function carregarCategorias() {
            fetch('/carregarCategorias')
                .then(response => response.json())
                .then(data => {
                    const selectCategoria = document.getElementById('categoria');
                    data.forEach(categoria => {
                        const option = document.createElement('option');
                        option.value = categoria.id;
                        option.textContent = categoria.nome;
                        selectCategoria.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar categorias:', error));
        }

        // Carregar categorias ao carregar a página
        document.addEventListener('DOMContentLoaded', carregarCategorias);
    </script>
</body>

</html>