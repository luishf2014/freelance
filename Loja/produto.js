document.addEventListener('DOMContentLoaded', () => {
    // Carrega as informações dos produtos do JSON
    fetch('../php/produtos.json')
        .then(response => response.json())
        .then(data => {
            const produtos = data.produtos;

            // Atualiza os cards de produtos dinamicamente
            updateProductCards(produtos);

            // Obtém o parâmetro 'id' da URL
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');

            if (productId) {
                // Atualiza os detalhes do produto com base no 'id'
                updateProductDetails(productId, produtos);
            }
        })
        .catch(error => console.error('Erro ao carregar o JSON:', error));
});

function updateProductCards(produtos) {
    const container = document.querySelector('.grid.grid-cols-1');

    produtos.forEach(produto => {
        let cardHTML = '';

        // Verifica se o produto tem preço anterior
        if (produto.precoAnterior) {
            cardHTML = `
                <a href="produto.html?id=${produto.id}">
                    <div class="border rounded-lg p-4 bg-card shadow-lg transition-transform transform hover:scale-105">
                        <img src="${produto.imagemPrincipal}" alt="${produto.nome}" class="w-full h-50 object-cover mb-2 rounded-lg" />
                        <h3 class="text-lg font-semibold">${produto.nome}</h3>
                        <div class="flex justify-between items-center mt-2">
                            <div>
                                <span class="text-red-500 line-through" style="font-size: 1.2em;">De: R$ ${produto.precoAnterior}</span>
                                <span class="text-green-500 font-bold block" style="font-size: 1.5em;">POR: R$ ${produto.precoAtual} no PIX</span>
                            </div>
                        </div>
                        <div class="text-sm text-muted-foreground" style="font-size: 1.1em;">2x de R$ ${parseFloat(produto.precoAtual / 2).toFixed(2)} no cartão 3x juros</div>
                        <span class="bg-black text-white text-xs rounded-full px-2 py-1 absolute top-2 right-2" style="font-size: 1.1em;">-${produto.desconto}</span>
                    </div>
                </a>
            `;
        } else {
            cardHTML = `
                <a href="produto.html?id=${produto.id}">
                    <div class="border rounded-lg p-4 bg-card shadow-lg transition-transform transform hover:scale-105">
                        <img src="${produto.imagemPrincipal}" alt="${produto.nome}" class="w-full h-50 object-cover mb-2 rounded-lg" />
                        <h3 class="text-lg font-semibold">${produto.nome}</h3>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-green-500 font-bold block" style="font-size: 1.5em;">POR: R$ ${produto.precoAtual} no PIX</span>
                        </div>
                        <div class="text-sm text-muted-foreground" style="font-size: 1.1em;">2x de R$ ${parseFloat(produto.precoAtual / 2).toFixed(2)} no cartão 3x juros</div>
                    </div>
                </a>
            `;
        }

        // Adiciona o card ao container
        container.innerHTML += cardHTML;
    });
}

function updateProductDetails(productId, produtos) {
    const produto = produtos.find(produto => produto.id == productId);

    if (produto) {
        // Atualiza os detalhes do produto na página de descrição
        document.getElementById('productName').textContent = produto.nome;
        document.getElementById('currentPrice').textContent = produto.precoAtual;
        document.getElementById('previousPrice').textContent = produto.precoAnterior;
        document.getElementById('productDescription').textContent = produto.descricao;
        document.getElementById('descriptionComplete').textContent = produto.descricaoCompleta;

        // Atualiza a imagem principal e as miniaturas
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail-images img');

        // Define a imagem principal
        mainImage.src = produto.imagens[0];

        // Atualiza as imagens das miniaturas
        produto.imagens.slice(1).forEach((imageUrl, index) => {
            if (index < thumbnails.length) {
                thumbnails[index].src = imageUrl;
                thumbnails[index].onclick = () => selectImage(index + 1);
            }
        });

        selectImage(0);
    }
}

let currentSlide = 0;

function selectImage(index) {
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail-images img');

    thumbnails[currentSlide].classList.remove('active');
    currentSlide = index;
    mainImage.src = thumbnails[index].src;
    thumbnails[currentSlide].classList.add('active');
}

function changeSlide(direction) {
    const thumbnails = document.querySelectorAll('.thumbnail-images img');
    let newSlide = currentSlide + direction;

    if (newSlide < 0) {
        newSlide = thumbnails.length - 1;
    } else if (newSlide >= thumbnails.length) {
        newSlide = 0;
    }

    selectImage(newSlide);
}
