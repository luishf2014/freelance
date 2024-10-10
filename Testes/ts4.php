<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kit Óleo e Balm para Barba Smaak Canela & Rum Embaixador</title>
    <style>
        .price-container {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .previous-price {
            margin-right: 20px;
            /* Espaço entre o preço anterior e o atual */
        }

        .current-price {
            margin-right: 10px;
            /* Espaço entre o preço atual e o desconto */
        }

        .payment-info {
            margin-left: auto;
            /* Alinha o texto à direita */
        }

        .installments-info {
            margin-top: 5px;
            /* Espaço acima do texto de parcelas */
            font-size: 16px;
            /* Tamanho do texto */
            color: #999;
            /* Cor do texto */
        }
    </style>
</head>

<body>
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
    <div class="price-container">
        <?php if (isset($product['precoAnterior']) && $product['precoAnterior'] > 0): ?>
            <div class="previous-price" style="color: red; text-decoration: line-through;">
                de R$ <?php echo number_format($product['precoAnterior'], 2, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <p class="current-price" style="font-size: 28px; color: green; font-weight: bold;">
            R$ <?php echo number_format($product['precoAtual'], 2, ',', '.'); ?>
        </p>

        <?php if (isset($product['porcentagemDesconto']) && $product['porcentagemDesconto'] > 0): ?>
            <span class="discount-label" style="background-color: red; color: white; padding: 3px 8px; border-radius: 5px; margin-left: 10px;">
                -<?php echo round($product['porcentagemDesconto'], 2); ?>%
            </span>
        <?php endif; ?>

        <span class="payment-info" style="color: #999;">
            💳 R$ <?php echo number_format($product['precoAtual'], 2, ',', '.'); ?> no PIX
        </span>

        <p class="installments-info">
            em até 2x de R$ <?php echo number_format($product['precoAtual'] / 2, 2, ',', '.'); ?> sem juros
        </p>
    </div>

</body>

</html>