// =======================================================
// DADOS UNIFICADOS DO CATÁLOGO (COM ID ÚNICO)
// =======================================================

let nextProductId = 5;

function processCatalogData(data) {
    const unifiedList = [];
    for (const key in data) {
        data[key].products.forEach(product => {
            if (!product.id) {
                product.id = nextProductId++;
            }
            product.categoryKey = key;
            unifiedList.push(product);
        });
    }
    return unifiedList;
}

const originalCatalogData = {
    fermentadas: {
        title: "Fermentadas: Cervejas, Vinhos e Mais",
        products: [
            { name: "Cerveja Itaipava 600ml", price: 7.50, img: "img/itaipava.jpg" },
            { name: "Vinho Tinto Malbec", price: 59.90, img: "img/vinho.webp" },
            { name: "Sidra Cereser", price: 15.00, img: "img/cereser.jpg" },
            { name: "Cerveja Artesanal Baden", price: 22.00, img: "img/baden.png" },
            { name: "Cerveja Pilsen Lata", price: 5.50, img: "img/pilsen.jpg" },
            { name: "Vinho Tinto Bordô Suave Góes", price: 29.90, img: "img/goes.jpg" },
        ]
    },
    destiladas: {
        title: "Destiladas: Fogo, Força e Sabor",
        products: [
            { name: "Cachaça Prata Seleta 1L", price: 25.00, img: "img/cachaca.webp" },
            { name: "Whisky Ballantines Finest 8 anos 1 Litro", price: 89.90, img: "img/whisky.jpg" },
            { name: "Gin Tônica Ready-to-Drink", price: 18.00, img: "img/gin.webp" },
            { name: "Tequila Jose Cuervo Ouro 750ml", price: 149.00, img: "img/tequila.jpg" },
            { name: "Vodka Smirnoff 1L", price: 65.00, img: "img/vodkas.webp" },
            { name: "Rum Bacardi", price: 55.00, img: "img/rum.jpg" },
        ]
    },
    licorosas: {
        title: "Licorosas: Doces e Aromáticas",
        products: [
            { name: "Licor 43 Chocolate 700ml", price: 45.00, img: "img/licor.webp" },
            { name: "Vermute Tinto Martini", price: 32.50, img: "img/vermute.jpg" },
            { name: "Aperitivo Amargo Campari 900ml", price: 55.00, img: "img/aperitivo.webp" },
            { name: "Licor de Café e Creme de Baunilha Sheridan's Irlandês 700ml", price: 160.00, img: "img/cafe.webp" },
        ]
    },
    'nao-alcoolicas': {
        title: "Não Alcoólicas: Hidratação e Energia",
        products: [
            { name: "Red Bull Energy Drink", price: 12.00, img: "img/redbull.webp" },
            { name: "Suco Natural Laranja 1,5L", price: 10.00, img: "img/suco.webp" },
            { name: "Água Mineral com Gás Crystal", price: 3.50, img: "img/agua.webp" },
            { name: "Gatorade Isotônico 500ml", price: 5.90, img: "img/gatorade.webp" },
        ]
    }
};

const mostSoldProducts = [
    { id: 1, name: "Cerveja Itaipava 600ml", price: 7.50, img: "img/itaipava.jpg" },
    { id: 2, name: "Vinho Tinto Malbec", price: 59.90, img: "img/vinho.webp" },
    { id: 3, name: "Vodka Smirnoff 1L", price: 65.00, img: "img/vodkas.webp" },
    { id: 4, name: "Gatorade Isotônico 500ml", price: 5.90, img: "img/gatorade.webp" },
];

const catalogProducts = processCatalogData(originalCatalogData);
const ALL_PRODUCTS = [...mostSoldProducts, ...catalogProducts];

const PRODUCT_MAP = ALL_PRODUCTS.reduce((acc, product) => {
    acc[product.id] = product;
    return acc;
}, {});

// =======================================================
// FUNÇÃO DE ZOOM (NOVO)
// =======================================================

function abrirZoom(src) {
    const modal = document.getElementById('modal-zoom');
    const imgModal = document.getElementById('img-zoom');
    if (modal && imgModal) {
        imgModal.src = src;
        modal.style.display = 'flex';
    }
}

// =======================================================
// CARRINHO & TOAST NOTIFICATION
// =======================================================

let cart = JSON.parse(localStorage.getItem('userCart')) || {};

function saveCart() {
    localStorage.setItem('userCart', JSON.stringify(cart));
}

function updateCartCount() {
    const countElement = document.getElementById("cart-count");
    if (countElement) {
        const total = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
        countElement.innerText = total;
    }
}

function showCartToast() {
    const toast = document.getElementById('cart-toast');
    if (toast) {
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000); 
    }
}

function addToCart(productId, qty = 1) {
    const product = PRODUCT_MAP[productId];
    if (!product) return;

    if (cart[productId]) {
        cart[productId].qty += qty;
    } else {
        cart[productId] = {
            id: product.id,
            name: product.name,
            img: product.img,
            price: product.price,
            qty: qty
        };
    }
    saveCart();
    updateCartCount();
    showCartToast();
}

// =======================================================
// FRONT-END (CATÁLOGO, BUSCA, CATEGORIAS)
// =======================================================

function formatPrice(price) {
    return `R$ ${price.toFixed(2).replace(".", ",")}`;
}

function createProductCard(product) {
    const isSubfolder = window.location.pathname.includes('/carrinho/') || 
                        window.location.pathname.includes('/sac/') || 
                        window.location.pathname.includes('/login/') ||
                        window.location.pathname.includes('/marinho/');

    const correctImgPath = isSubfolder ? "../" + product.img : "./" + product.img;

    return `
        <article class="product-card" data-id="${product.id}">
            <img src="${correctImgPath}" alt="${product.name}" onclick="abrirZoom(this.src)" style="cursor: zoom-in;">
            <p class="product-name">${product.name}</p>
            <div class="product-details-bottom">
                <p class="product-price">${formatPrice(product.price)}</p>
                <button class="add-to-cart" data-id="${product.id}" aria-label="Adicionar ${product.name} ao carrinho">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </div>
        </article>
    `;
}

function attachCartEvents() {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.onclick = (e) => {
            e.preventDefault();
            const id = parseInt(button.dataset.id);
            if (!isNaN(id)) addToCart(id);
        };
    });
}

function renderCatalog(category) {
    const data = originalCatalogData[category];
    const grid = document.getElementById("catalog-results");
    if (!data || !grid) return;

    document.getElementById("catalog-title").innerText = data.title;
    grid.innerHTML = "";

    data.products.forEach(prod => {
        const fullProduct = PRODUCT_MAP[prod.id] || prod; 
        grid.innerHTML += createProductCard(fullProduct);
    });
    attachCartEvents();
}

function renderSearchResults(query) {
    const grid = document.getElementById("catalog-results");
    const catalogTitle = document.getElementById("catalog-title");
    if (!grid) return;
    
    if (!query || query.trim().length === 0) {
        const activeChip = document.querySelector('.chip.active');
        renderCatalog(activeChip ? activeChip.dataset.category : "fermentadas");
        return;
    }
    
    const filteredProducts = ALL_PRODUCTS.filter(product =>
        product.name.toLowerCase().includes(query.toLowerCase())
    );

    catalogTitle.innerText = `Resultados da Busca por: "${query}"`;
    grid.innerHTML = filteredProducts.length === 0 
        ? "<p style='padding: 20px; width: 100%; text-align: center;'>Nenhum produto encontrado.</p>" 
        : filteredProducts.map(p => createProductCard(p)).join("");

    attachCartEvents();
}

function attachSearchToggleEvents() {
    const searchIcon = document.getElementById('search-icon');
    const searchBar = document.getElementById('search-bar');
    const closeSearchButton = document.getElementById('close-search');
    const searchInput = searchBar ? searchBar.querySelector('.search-input') : null;

    if (!searchIcon || !searchBar || !closeSearchButton || !searchInput) return;

    searchIcon.addEventListener('click', () => {
        searchBar.classList.add('active');
        searchInput.focus();
        document.querySelectorAll(".chip").forEach(c => c.classList.remove("active"));
    });

    closeSearchButton.addEventListener('click', () => {
        searchBar.classList.remove('active');
        searchInput.value = '';
        const initialChip = document.querySelector('.chip[data-category="fermentadas"]');
        if (initialChip) {
            initialChip.classList.add("active");
            renderCatalog("fermentadas");
        }
    });
    
    searchInput.addEventListener('input', (event) => {
        renderSearchResults(event.target.value);
    });
}

// =======================================================
// INICIALIZAÇÃO
// =======================================================

document.addEventListener("DOMContentLoaded", () => {
    attachSearchToggleEvents(); 
    
    const chips = document.querySelectorAll(".chip");
    chips.forEach(chip => {
        chip.addEventListener("click", () => {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) searchInput.value = '';

            chips.forEach(c => c.classList.remove("active"));
            chip.classList.add("active");
            renderCatalog(chip.dataset.category);
        });
    });

    const initialChip = document.querySelector('.chip[data-category="fermentadas"]');
    if (initialChip) {
        initialChip.classList.add("active");
        renderCatalog("fermentadas");
    }
    
    updateCartCount();
});