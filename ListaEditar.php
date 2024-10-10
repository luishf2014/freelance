<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
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

        main {
            width: 1300px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 600;
            text-align: center;
        }

        .filter-bar {
            margin-bottom: 20px;
            text-align: center;
        }

        .filter-bar input {
            padding: 8px;
            width: 500px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            /* Alinha verticalmente o conteúdo das células */
            height: 50px;
            /* Define a altura mínima das células */
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            /* Ajuste a largura máxima conforme necessário */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            /* Garante que o conteúdo não exceda os limites da tabela */
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            /* Alinha verticalmente o conteúdo das células */
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Estilos gerais para os botões de ação */
        .action-buttons {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Hover para o botão de edição */
        .edit-btn:hover {
            background-color: #ffc107;
            /* Amarelo */
            color: #000000;
            /* Preto */
        }

        /* Hover para o botão de remoção */
        .remove-btn:hover {
            background-color: #dc3545;
            /* Vermelho */
            color: #ffffff;
            /* Branco */
        }

        /**/
        .vermais-btn:hover {
            background-color: #007bff;
            color: white;
            text-decoration: none;
        }

        /* Estilos para o pop-up */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            width: 400px;
            max-width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .popup-content h2 {
            margin-top: 0;
        }

        .popup-content p {
            margin: 10px 0;
        }

        .popup-button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm-button {
            background-color: #28a745;
        }

        .cancel-button {
            background-color: #dc3545;
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
                <Li><a href="AdicionarItens.php">Adicionar</a></Li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Lista de Produtos Para Editar</h1>

        <!-- Barra de filtro -->
        <div class="filter-bar">
            <input type="text" id="filterInput" placeholder="Filtrar produtos por nome, marca ou categoria...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th class="truncate">Nome</th>
                    <th>Marca</th>
                    <th>Preço Atual</th>
                    <th>Preço Anterior</th>
                    <th>Desconto</th>
                    <th>Parcela</th>
                    <th colspan="3" style="text-align: center;">Ação</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <?php
                // Conecte-se ao banco de dados
                require_once '/xampp/htdocs/_aProjeto/teste/php/BD.php'; // Ajuste o caminho conforme necessário

                // Busque todos os produtos
                $query = "SELECT p.id, p.nome, p.marca, p.precoAtual, p.precoAnterior, p.parcelas, p.descricaoCompleta, c.nome AS categoria_nome
                FROM produtos p
                JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id ASC";
                $result = $banco->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Calcule o desconto
                        $precoAnterior = $row['precoAnterior'];
                        $precoAtual = $row['precoAtual'];
                        $desconto = ($precoAnterior > 0) ? round(((($precoAnterior - $precoAtual) / $precoAnterior) * 100)) . '%' : 'Sem desconto';

                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['categoria_nome']}</td>
                            <td class='truncate'>{$row['nome']}</td>
                            <td>{$row['marca']}</td>
                            <td>R$ " . number_format($row['precoAtual'], 2, ',', '.') . "</td>
                            <td>R$ " . number_format($row['precoAnterior'], 2, ',', '.') . "</td>
                            <td>{$desconto}</td>
                            <td>{$row['parcelas']}x</td>
                            <td><a href='EditarItens.php?id={$row['id']}' class='action-buttons edit-btn'>Editar</a></td>
                            <td><a href='#' class='action-buttons remove-btn' data-id='{$row['id']}' data-nome='{$row['nome']}' data-marca='{$row['marca']}' data-precoAtual='{$row['precoAtual']}' data-precoAnterior='{$row['precoAnterior']}' data-parcelas='{$row['parcelas']}'>Remover</a></td>
                            <td><a href='#' class='action-buttons vermais-btn' data-id='{$row['id']}' data-nome='{$row['nome']}' data-marca='{$row['marca']}' data-precoAtual='{$row['precoAtual']}' data-precoAnterior='{$row['precoAnterior']}' data-parcelas='{$row['parcelas']}' data-descricao='{$row['descricaoCompleta']}'>Ver mais</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pop-up para "Ver mais" e "Remover" -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-button" id="closePopup">&times;</span>
                <h2 id="popupTitle">Título do Pop-up</h2>
                <div id="popupContent">
                    <!-- Conteúdo dinâmico vai aqui -->
                </div>
                <button id="confirmButton" class="popup-button confirm-button">Confirmar</button>
                <button id="cancelButton" class="popup-button cancel-button">Cancelar</button>
            </div>
        </div>

        <div id="toast" class="toast hidden">
            <div id="toast-icon"></div>
            <div id="toast-message"></div>
        </div>

    </main>

    <script>
        // Função de filtragem
        document.getElementById('filterInput').addEventListener('keyup', function() {
            var filterValue = this.value.toLowerCase();
            var rows = document.getElementById('productTable').getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var match = false;

                for (var j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(filterValue) > -1) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        });

        // Mostrar pop-up
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Obter informações do produto a partir dos atributos data-*
                var id = this.getAttribute('data-id');
                var nome = this.getAttribute('data-nome');
                var marca = this.getAttribute('data-marca');
                var precoAtual = parseFloat(this.getAttribute('data-precoAtual'));
                var precoAnterior = parseFloat(this.getAttribute('data-precoAnterior'));
                var parcelas = this.getAttribute('data-parcelas');

                // Referências ao pop-up e conteúdo do pop-up
                var popup = document.getElementById('popup');
                var popupContent = document.getElementById('popupContent');

                // Atualizar título e conteúdo do pop-up para a remoção
                document.getElementById('popupTitle').textContent = 'Remover Produto';

                // Construir o conteúdo do pop-up
                var contentHTML = `
            <p><strong>ID:</strong> ${id}</p>
            <p><strong>Nome:</strong> ${nome}</p>
            <p><strong>Marca:</strong> ${marca}</p>
            <p><strong>Preço Atual:</strong> R$ ${precoAtual.toFixed(2).replace('.', ',')}</p>`;

                // Verificar se existe um preço anterior válido e calcular o desconto
                if (precoAnterior > 0) {
                    contentHTML += `<p><strong>Preço Anterior:</strong> R$ ${precoAnterior.toFixed(2).replace('.', ',')}</p>`;
                    // Calcular o desconto
                    var desconto = Math.round(((precoAnterior - precoAtual) / precoAnterior) * 100);
                    contentHTML += `<p><strong>Desconto:</strong> ${desconto}%</p>`;
                } else {
                    contentHTML += `<p><strong>Desconto:</strong> Sem desconto</p>`;
                }

                contentHTML += `<p><strong>Parcelas:</strong> ${parcelas}x</p>`;
                contentHTML += `<p>Tem certeza de que deseja remover este produto?</p>`;

                // Inserir o conteúdo construído no pop-up
                popupContent.innerHTML = contentHTML;

                // Mostrar o pop-up
                popup.style.display = 'flex';

                // Lidar com a confirmação de remoção
                document.getElementById('confirmButton').onclick = function() {
                    // Chamar a função para excluir o produto
                    deleteProduct(id);
                    // Fechar o pop-up após a exclusão
                    popup.style.display = 'none';
                };

                // Lidar com o botão de cancelamento da exclusão
                document.getElementById('cancelButton').onclick = function() {
                    popup.style.display = 'none';
                };
            });
        });

        // Fechar pop-up
        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

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

        // Função para excluir o produto
        function deleteProduct(productId) {
            fetch(`php/RemoverProduto.php?id=${productId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Produto removido com sucesso! 🚀', 'success');
                        // Recarregar a lista de produtos ou a página parcial
                        atualizarListaDeProdutos(); // Função que carrega a lista novamente, por exemplo.
                    } else {
                        showToast('Erro ao remover o produto. Tente novamente.', 'error');
                    }
                })
                .catch(error => {
                    showToast('Erro ao remover o produto. Tente novamente.', 'error');
                });
        }
    </script>
</body>

</html>