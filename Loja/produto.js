document.addEventListener('DOMContentLoaded', () => {
    // Obtém o parâmetro 'id' da URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    if (productId) {
        // Atualiza os detalhes do produto com base no 'id'
        updateProductDetails(productId);
    }
});

function updateProductDetails(productId) {
    // Dados fictícios para os produtos
    const products = {
        "1": {
            name: "Kit Óleo e Balm para Barba Smaak Canela & Rum Embaixador",
            currentPrice: "R$ 47,48",
            previousPrice: "R$ 134,80",
            description: "Aqui vai uma breve descrição do Kit Óleo e Balm.",
            images: [
                "https://619028l.ha.azioncdn.net/img/2024/05/produto/27100/d9630w-capa.jpg?ims=500x500",
                "/Uploads/logo.png",
                "https://619028l.ha.azioncdn.net/img/2024/05/produto/27100/d9630w-capa.jpg?ims=500x500",
                "/Uploads/logo.png"
            ],
            descriptionComplete: "Em breve um descrição completa"
        },
        "2": {
            name: "Tesoura Fio Navalha Titan A60 6.0 Polegadas",
            currentPrice: "R$ 349,99",
            // previousPrice: "R$ 399,99",
            description: "Aqui vai uma breve descrição da Tesoura Fio Navalha.",
            images: [
                "https://619028l.ha.azioncdn.net/img/2024/03/produto/26907/smaak-canela.jpg?ims=500x500",
                "https://example.com/imagem2.jpg",
                "https://example.com/imagem3.jpg",
                "https://example.com/imagem4.jpg"
            ],
            descriptionComplete: "Em breve um descrição completa"
        }
    };

    const product = products[productId];

    if (product) {
        document.getElementById('productName').textContent = product.name;
        document.getElementById('currentPrice').textContent = product.currentPrice;
        document.getElementById('previousPrice').textContent = product.previousPrice;
        document.getElementById('productDescription').textContent = product.description;
        document.getElementById('descriptionComplete').textContent = product.descriptionComplete;

        // Atualiza as imagens do carrossel e miniaturas
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail-images img');

        product.images.forEach((imageUrl, index) => {
            thumbnails[index].src = imageUrl;
            thumbnails[index].onclick = () => selectImage(index);

            if (index === 0) {
                mainImage.src = imageUrl;
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
