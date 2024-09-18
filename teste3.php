<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto - Nome do Produto</title>
    <style>
        /* Estilo geral */
        /* body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        } */

        /* Container do produto */
        .product-container {
            display: flex;
            gap: 40px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 50px rgba(0, 0, 0, 0.2);
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 2rem;
        }

        /* Estilo das imagens do produto */
        .product-images {
            flex: 1;
            display: flex;
            gap: 20px;
        }

        .carousel {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .carousel img {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            color: #333;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 30px;
            line-height: 1;
            transition: color 0.3s;
            z-index: 2;
        }

        .carousel-arrow.prev {
            left: 10px;
        }

        .carousel-arrow.next {
            right: 10px;
        }

        .carousel-arrow:hover {
            color: #007bff;
        }

        /* Miniaturas */
        .thumbnail-images {
            display: flex;
            flex-direction: column;
            gap: 15px;
            justify-content: center;
        }

        .thumbnail-images img {
            width: 90px;
            height: 90px;
            cursor: pointer;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }

        .thumbnail-images img:hover,
        .thumbnail-images img.active {
            border-color: #007bff;
        }

        /* Detalhes do produto */
        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #222;
            margin-top: 25px;
        }

        .product-details .price {
            font-size: 32px;
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-details .discount {
            font-size: 20px;
            text-decoration: line-through;
            color: red;
            margin-left: 15px;
        }

        .product-details .description {
            margin: 20px 0;
            line-height: 1.8;
            color: #555;
            font-size: 18px;
        }

        .product-details .buy-now {
            background-color: #007bff;
            color: #fff;
            padding: 12px 25px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .product-details .buy-now:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Descrição detalhada do produto */
        .product-description {
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #fff;
        }

        .product-description h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #444;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .product-description p {
            font-size: 18px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 20px;
        }

        .product-description ul {
            list-style-type: disc;
            padding-left: 20px;
            margin: 20px 0;
        }

        .product-description ul li {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
        }
    </style>
    <!-- <link rel="stylesheet" href="/Loja/Estilos_Shop/Descktop_Shop.css"> -->
    <link rel="stylesheet" href="/Estilos_Genericos/Botao.css">
    <link rel="stylesheet" href="/Estilos_Genericos/Geral.css">
</head>

<body>
    <header style="background-color: black;">
        <!-- Seu cabeçalho aqui -->
        <div class="container-logo">
            <div><a href="home.html"><img src="/Uploads/logoMenorBrancaSemFundo.png" alt="marca" class="logo-imagem"
                        style="background-color: black;"></a>
            </div>
            <!-- <div class="logo-texto">
                <h3>
                    <p><I>CAMISA 10</I></p>
                </h3>
            </div> -->
        </div><!-- container-logo -->
        <nav class="menu"><!-- Seu menu de navegação aqui -->
            <ul class="ul-mobile">
                <li><a href="home.html" class="elemento1" style="border-bottom-width: 0px;">Quem Somos</a></li>
                <!--Quem Somos -->
                <li><a href="Shop2.html" class="ButtonB" style="border-bottom-width: 0px;">Shop2</a></li>
                <li><a href="https://raza589.gendo.app/#/" class="buttonP">Agende
                        seu horário</a></li>
                <!-- <li><a href="login.html" class="elemento1"> login</a></li> -->
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
    <div class="product-container">
        <div class="product-images">
            <div class="thumbnail-images">
                <img src="" alt="" class="active"> <!-- Miniatura 1 -->
                <img src="" alt=""> <!-- Miniatura 2 -->
                <img src="" alt=""> <!-- Miniatura 3 -->
                <img src="" alt=""> <!-- Miniatura 4 -->
            </div>
            <div class="carousel">
                <button class="carousel-arrow prev" onclick="changeSlide(-1)">&#10094;</button>
                <img id="mainImage" src="" alt="">
                <button class="carousel-arrow next" onclick="changeSlide(1)">&#10095;</button>
            </div>
        </div>

        <div class="product-details">
            <h1 id="productName">Nome do Produto</h1>
            <p class="price"><span id="currentPrice">PRECO_ATUAL</span> <span class="discount"><span
                        id="previousPrice">PRECO_ANTERIOR</span></span></p>
            <p class="description" id="productDescription">Breve descrição do produto, destacando suas características
                principais.</p>
            <button class="buttonB">Comprar Agora</button>
        </div>
    </div>

    <div class="product-description">
        <h2>Descrição Detalhada</h2>
        <div id="conteudo"></div>
        <script>
            // Função para formatar o texto
            function formatarTexto(texto) {
                const linhas = texto.split('\n');
                let textoFormatado = '';

                linhas.forEach((linha) => {
                    if (linha.startsWith('# ')) {
                        textoFormatado += `<h1>${linha.substring(2).trim()}</h1>`;
                    } else if (linha.startsWith('## ')) {
                        textoFormatado += `<h2>${linha.substring(3).trim()}</h2>`;
                    } else if (linha.startsWith('### ')) {
                        textoFormatado += `<h3>${linha.substring(4).trim()}</h3>`;
                    } else if (linha.trim() === '') {
                        textoFormatado += '<br>';
                    } else {
                        textoFormatado += `<p>${linha.trim()}</p>`;
                    }
                });

                return textoFormatado;
            }

            // Função para mostrar o texto formatado
            function mostrarTextoFormatado(texto) {
                const conteudo = document.getElementById('conteudo');
                conteudo.innerHTML = formatarTexto(texto);
            }

            // PHP para buscar e passar o texto formatado
            <?php
            require_once '/xampp/htdocs/_aProjeto/teste/php/BD.php';

            // Consulta SQL
            $busca = "SELECT descricaoCompleta FROM produtos WHERE id ";
            $result = $banco->query($busca);

            if ($result->num_rows > 0) {
                // Buscar o texto
                $row = $result->fetch_assoc();
                $texto = $row['descricaoCompleta'];
            } else {
                $texto = ''; // Caso não haja texto
            }
            ?>
            // Passa o texto recuperado do PHP para o JavaScript
            const texto = <?php echo json_encode($texto); ?>;
            mostrarTextoFormatado(texto); // Chama a função do Formatador.js
        </script>
    </div>



    <!-- Importa o arquivo JavaScript externo -->
    <script src="../Loja/produto.js"></script>
    <footer>
        <div class="footer-container">
            <div class="redes-sociais">
                <h2>
                    <p>- Redes Sociais -</p>
                </h2>
                <a href="https://www.instagram.com/camisa10.barbearia_/">
                    <img src="..\Uploads\logoInstagram.jpeg" alt="Instagram" class="redes-sociais">
                </a>
                <!-- <p>@camisa10.barbearia_</p> -->
            </div>
            <div class="horario">
                <h2>
                    <p> - Horários - </p>
                </h2>
                <h5>
                    <p>Terça à Sexta: 09h às 19h | Sábado 09:30h às 18h | Domingo e Segunda: Fechado</p>
                </h5>
            </div>
            <div class="redes-sociais"> <!--class="contato"-->
                <h2>
                    <p>- Contato - </p>
                </h2>
                <!-- <p>Email: contato@camisa10.barbearia.com</p> -->
                <!-- <p>Telefone: (99) 99999-9999</p> -->
                <a href="https://www.instagram.com/camisa10.barbearia_/">
                    <img src="https://t3.ftcdn.net/jpg/05/32/20/62/240_F_532206245_N1xYEHrZVIWU1ihamWwmDbh1gZWGU7Jl.jpg"
                        alt="Instagram" class="redes-sociais">
                </a>
            </div>

        </div>
        <div class="direitos-autorais">
            <div class="direitos-autorais-linha"></div>
            <p>&copy; 2024 - Luis Henrique Mota da Fonseca. Todos os direitos reservados.</p>
        </div>

    </footer>
</body>

</html>