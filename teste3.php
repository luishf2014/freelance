<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto - Nome do Produto</title>
    <style>
        
        /* Container do produto */
        .product-container {
            display: flex;
            gap: 40px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 50px rgba(0, 0, 0, 0.2);
            max-width: 1250px;
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
            padding: 20px 50px;
            border-radius: 8px;
            background-color: #fff;
        }


        .product-details h1 {
            font-size: 26px;
            /* Tamanho do título ajustado */
            margin: 10px 0;
            /* Margens ajustadas */
            color: #222;
            /* Cor escura */
        }

        .product-details .price {
            font-size: 28px;
            /* Tamanho do preço */
            color: #000;
            /* Preto */
            font-weight: bold;
            color: green;
            display: flex;
            /* justify-content: space-around; */
        }

        .product-details .price2 {
            font-size: 20px;
            /* Tamanho do preço */
            color: #000;
            /* Preto */
            font-weight: bold;
            margin-left: 27px;

        }

        .product-details .discount {
            font-size: 18px;
            /* Tamanho da descrição do desconto */
            text-decoration: line-through;
            color: #999;
            /* Cinza claro */
            margin-left: 10px;
            /* Margem esquerda */
        }

        .product-details .description {
            margin: 20px 0;
            line-height: 1.6;
            /* Altura da linha ajustada */
            color: #333;
            /* Cinza escuro */
            font-size: 16px;
            /* Tamanho da descrição */
        }

        .product-details .buy-now {
            background-color: #000;
            /* Fundo preto */
            color: #fff;
            /* Texto branco */
            padding: 10px 20px;
            /* Padding ajustado */
            border: none;
            cursor: pointer;
            font-size: 16px;
            /* Tamanho do texto do botão */
            border-radius: 5px;
            /* Bordas arredondadas */
            transition: background-color 0.3s, transform 0.2s;
            /* Transição suave */
            text-transform: uppercase;
            /* Letras maiúsculas */
            
        }

        .product-details .buy-now:hover {
            background-color: #333;
            /* Cinza escuro ao passar o mouse */
            transform: translateY(-2px);
            /* Efeito de elevação */
        }

        .price-installments {
            font-size: 16px;
            /* Tamanho da descrição das parcelas */
            color: #555;
            /* Cinza médio */
            margin-left: 100px;

        }

        .previousPrice {
            margin-left: 27px;
            margin-top: 15px;
            font-size: 1.2rem;
            color: #999
        }

        .msg-obs {
            font-size: 15px;
            color: #555;
            margin-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
            margin-bottom: 20px;
        }
        .msg-obs .p{
            text-align: left;
        }

        /* Porcentagem desconto */
        .desconto-label {
            background-color: red;
            color: white;
            padding: 3px 5px;
            border-radius: 5px;
            margin-left: 10px;
            font-size: 17px;
        }

        /* Descrição detalhada do produto */
        .product-description {
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #fff;
            max-width: 1250px;
        }

        .product-description h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #444;
            /* border-bottom: 2px solid #007bff; Azul */
            border-bottom: 2px solid #000;
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
    <link rel="stylesheet" href="Loja/Estilos_Shop/Descktop_Shop.css">
    <link rel="stylesheet" href="Estilos_Genericos/Botao.css">
    <link rel="stylesheet" href="Estilos_Genericos/Geral.css">
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
            <h1 id="productName">
                <?php echo htmlspecialchars($product['nome']); ?>
            </h1>

            <?php if (isset($product['precoAnterior']) && $product['precoAnterior'] > 0): ?>
                <div class="previousPrice">
                    de <span style="color: red; font-weight: bold; text-decoration: line-through;">R$ <?php echo number_format($product['precoAnterior'], 2, ',', '.'); ?></span> por
                </div>
            <?php endif; ?>

            <div class="price">
                <div>
                    <img src="https://public-resources.zordcdn.com.br/assets/global/common-icons/payment-icons/icon-pix.svg" style="color:#000" alt="imagem pix">
                    <span id="currentPrice">R$ <?php echo number_format($product['precoAtual'], 2, ',', '.'); ?></span>

                    <?php if (isset($product['precoAnterior']) && $product['precoAnterior'] > 0): ?>
                        <span class="desconto-label">
                            -<?php echo round($product['porcentagemDesconto'], 2); ?>%
                        </span>
                    <?php endif; ?>
                    <div class="price2">
                        <span class="price-info" style="color: #555;">no PIX</span>
                    </div>
                </div>

                <div class="price-installments">
                    <div style="font-size: 28px;">
                        <img src="https://public-resources.zordcdn.com.br/assets/global/common-icons/payment-icons/icon-pix.svg" style="color:#000" alt="imagem pix">
                        R$ <?php echo number_format($product['precoAtual'], 2, ',', '.'); ?>
                    </div>

                    <section style="margin-left: 27px;">
                        <div>
                            no cartão em até <?php echo intval($product['parcelas']); ?>x
                        </div>
                        <div>
                            de R$
                            <strong>

                                <?php
                                // Evitar divisão por zero
                                $parcelas = max(intval($product['parcelas']), 1);
                                echo number_format($product['precoAtual'] / $parcelas, 2, ',', '.');
                                ?> </strong> sem juros
                        </div>
                    </section>
                </div>
            </div>
            <button class="buy-now">Comprar Agora</button>
            <div class="msg-obs">
                <div style="text-align: center;">
                    <strong >
                        Observações:
                    </strong>
                </div>
                <p class="p">* Caro cliente, o prazo de entrega começará a contar a partir do momento que a encomenda for despachada pela loja.</p>
                <p class="p">* Devido as transportadoras não realizarem entregas em zonas rurais, de risco ou de difícil acesso, favor informar CEP específico de sua rua para o resultado correto</p>
            </div>

            
        </div>

    </div>

    <div class="product-description">
        <h2>Descrição Detalhada</h2>
        <div id="conteudo"></div>
        <script src="/_aProjeto/teste/Scripts/Formatador.js"></script>
        <script>
            const texto = <?php echo json_encode($product['descricaoCompleta']); ?>;
            mostrarTextoFormatado(texto);
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