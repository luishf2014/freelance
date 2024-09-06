<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de Texto Formatado</title>

    <script src="/Scripts/Formatador.js"></script> <!-- Certifique-se de que este caminho está correto -->

    <style>
        /* Estilos para o texto formatado */
        h1,
        h2,
        h3 {
            margin: 10px 0;
            /* Espaço acima e abaixo dos títulos */
            font-weight: bold;
            /* Garante que os títulos estejam em negrito */
        }

        p {
            margin: 5px 0;
            /* Espaço acima e abaixo dos parágrafos */
        }

        br {
            display: block;
            content: "";
            margin: 25px 0;
            /* Ajuste o valor conforme necessário */
        }
    </style>
</head>

<body>
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
        $busca = "SELECT descricaoCompleta FROM produtos WHERE id = 5";
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
</body>

</html>