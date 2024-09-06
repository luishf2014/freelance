document.addEventListener('DOMContentLoaded', () => {
    loadProducts();

    document.getElementById('productForm').addEventListener('submit', handleFormSubmit);
});

function handleFormSubmit(event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const precoAtual = document.getElementById('precoAtual').value;
    const precoAnterior = document.getElementById('precoAnterior').value;
    const descricao = document.getElementById('descricao').value;
    const descricaoCompleta = document.getElementById('descricaoCompleta').value;
    const productImages = document.getElementById('productImages').files;

    // Faz o upload das imagens
    uploadImages(productImages)
        .then(imageUrls => {
            const product = {
                id: Date.now(),
                nome,
                precoAtual,
                precoAnterior,
                descricao,
                descricaoCompleta,
                imagens: imageUrls
            };

            return addProductToJSON(product);
        })
        .then(result => {
            if (result.success) {
                alert('Produto adicionado com sucesso!');
                loadProducts();
            } else {
                alert('Erro ao adicionar o produto: ' + (result.message || 'Desconhecido'));
            }
        })
        .catch(error => console.error('Erro ao adicionar produto:', error));

    document.getElementById('productForm').reset();
}

function uploadImages(files) {
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    return fetch('../php/upload_images.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            return result.files;
        } else {
            throw new Error(result.message || 'Erro ao fazer o upload das imagens.');
        }
    });
}

function addProductToJSON(product) {
    return fetch('../php/save_products.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            produtos: [product] // Aqui você pode enviar um array de produtos se preferir
        })
    })
    .then(response => response.json());
}

function loadProducts() {
    fetch('../php/produtos.json')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            if (data.produtos && Array.isArray(data.produtos)) {
                data.produtos.forEach((product, index) => {
                    const productItem = document.createElement('div');
                    productItem.className = 'product-item';
                    productItem.innerHTML = `
                        <h2>${product.nome}</h2>
                        <p>Preço Atual: ${product.precoAtual}</p>
                        <p>Preço Anterior: ${product.precoAnterior}</p>
                        <p>${product.descricao}</p>
                        <img src="${product.imagens[0]}" alt="${product.nome}" style="width: 100px;">
                        <button onclick="editProduct(${index})">Editar</button>
                        <button onclick="deleteProduct(${index})">Excluir</button>
                    `;
                    productList.appendChild(productItem);
                });
            } else {
                console.error('Erro: data.produtos é undefined ou não é um array');
            }
        })
        .catch(error => console.error('Erro ao carregar produtos:', error));
}

function editProduct(index) {
    // Implementar função para editar produto
}

function deleteProduct(index) {
    fetch('../php/produtos.json')
        .then(response => response.json())
        .then(data => {
            if (data.produtos && Array.isArray(data.produtos)) {
                data.produtos.splice(index, 1);

                return fetch('../php/save_products.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
            } else {
                throw new Error('Erro: data.produtos é undefined ou não é um array');
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Produto excluído com sucesso!');
                loadProducts();
            } else {
                alert('Erro ao excluir o produto: ' + (result.message || 'Desconhecido'));
            }
        })
        .catch(error => console.error('Erro ao excluir produto:', error));
}
