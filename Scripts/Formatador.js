// Função para adicionar estilos CSS
function adicionarEstilos() {
    const style = document.createElement('style');
    style.innerHTML = `
        h1,
        h2,
        h3 {
            margin: 10px 0;
            font-weight: bold;
        }

        p {
            margin: 5px 0;
        }

        br {
            display: block;
            content: "";
            margin: 25px 0;
        }
    `;
    document.head.appendChild(style);
}

// Chame a função ao carregar o script
adicionarEstilos();

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
