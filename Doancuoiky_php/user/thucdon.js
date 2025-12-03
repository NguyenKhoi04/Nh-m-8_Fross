// Product Data
    const products = [
        // Coffee
        {
            id: 1,
            name: 'Espresso',
            category: 'coffee',
            price: 45000,
            icon: '☕',
            description: 'Cafe Ý đậm đà, thơm nồng với hương vị đặc trưng từ hạt Arabica cao cấp',
            badge: 'Hot'
        },
        {
            id: 2,
            name: 'Cappuccino',
            category: 'coffee',
            price: 50000,
            icon: '☕',
            description: 'Sự kết hợp hoàn hảo giữa espresso và sữa tươi, phủ lớp bọt mịn màng'
        },
        {
            id: 3,
            name: 'Latte',
            category: 'coffee',
            price: 48000,
            icon: '☕',
            description: 'Cafe latte mềm mại với lớp bọt sữa nghệ thuật đẹp mắt'
        },
        {
            id: 4,
            name: 'Americano',
            category: 'coffee',
            price: 42000,
            icon: '☕',
            description: 'Espresso pha loãng với nước nóng, giữ nguyên hương vị cafe đậm đà'
        },
        {
            id: 5,
            name: 'Caramel Macchiato',
            category: 'coffee',
            price: 55000,
            icon: '☕',
            description: 'Cafe macchiato thơm ngon với caramel và vani',
            badge: 'Mới'
        },
        {
            id: 6,
            name: 'Mocha',
            category: 'coffee',
            price: 52000,
            icon: '☕',
            description: 'Sự kết hợp tuyệt vời giữa cafe, chocolate và sữa tươi'
        },

        // Cakes
        {
            id: 7,
            name: 'Tiramisu',
            category: 'cake',
            price: 65000,
            icon: '🍰',
            description: 'Bánh Tiramisu Ý truyền thống với lớp kem mascarpone mềm mịn',
            badge: 'Best Seller'
        },
        {
            id: 8,
            name: 'Red Velvet',
            category: 'cake',
            price: 60000,
            icon: '🍰',
            description: 'Bánh nhung đỏ với lớp kem cheese thơm béo'
        },
        {
            id: 9,
            name: 'Chocolate Cake',
            category: 'cake',
            price: 58000,
            icon: '🍰',
            description: 'Bánh socola đậm đà cho người yêu chocolate'
        },
        {
            id: 10,
            name: 'Cheesecake',
            category: 'cake',
            price: 62000,
            icon: '🧀',
            description: 'Bánh phô mai New York kiểu cổ điển'
        },
        {
            id: 11,
            name: 'Matcha Cake',
            category: 'cake',
            price: 63000,
            icon: '🍰',
            description: 'Bánh trà xanh Nhật Bản với vị đắng nhẹ thanh tao',
            badge: 'Mới'
        },
        {
            id: 12,
            name: 'Strawberry Shortcake',
            category: 'cake',
            price: 59000,
            icon: '🍰',
            description: 'Bánh kem dâu tươi mát lạnh, ngọt ngào'
        },

        // Tea & Drinks
        {
            id: 13,
            name: 'Trà Sữa Trân Châu',
            category: 'tea',
            price: 40000,
            icon: '🍵',
            description: 'Trà sữa trân châu đường đen thơm ngon, dai dai',
            badge: 'Hot'
        },
        {
            id: 14,
            name: 'Trà Đào Cam Sả',
            category: 'tea',
            price: 45000,
            icon: '🍵',
            description: 'Trà trái cây tươi mát với đào, cam và sả thom'
        },
        {
            id: 15,
            name: 'Matcha Latte',
            category: 'tea',
            price: 48000,
            icon: '🍵',
            description: 'Trà xanh matcha Nhật pha với sữa tươi'
        },
        {
            id: 16,
            name: 'Trà Hoa Cúc',
            category: 'tea',
            price: 35000,
            icon: '🌼',
            description: 'Trà hoa cúc thanh mát, giải nhiệt tốt'
        },
        {
            id: 17,
            name: 'Sinh Tố Bơ',
            category: 'tea',
            price: 42000,
            icon: '🥑',
            description: 'Sinh tố bơ sánh mịn, bổ dưỡng'
        },
        {
            id: 18,
            name: 'Nước Ép Cam',
            category: 'tea',
            price: 38000,
            icon: '🍊',
            description: 'Nước cam tươi vắt 100% không đường'
        },

        // Breads
        {
            id: 19,
            name: 'Croissant Bơ',
            category: 'bread',
            price: 35000,
            icon: '🥐',
            description: 'Bánh sừng bò Pháp giòn tan với lớp bơ thơm',
            badge: 'Best Seller'
        },
        {
            id: 20,
            name: 'Pain Au Chocolat',
            category: 'bread',
            price: 38000,
            icon: '🥐',
            description: 'Bánh sừng bò nhân socola Bỉ cao cấp'
        },
        {
            id: 21,
            name: 'Bánh Mì Sandwich',
            category: 'bread',
            price: 42000,
            icon: '🥪',
            description: 'Sandwich thịt nguội, rau xanh và sốt đặc biệt'
        },
        {
            id: 22,
            name: 'Bagel',
            category: 'bread',
            price: 40000,
            icon: '🥯',
            description: 'Bánh bagel mềm mịn với cream cheese'
        },
        {
            id: 23,
            name: 'Danish Pastry',
            category: 'bread',
            price: 36000,
            icon: '🥐',
            description: 'Bánh ngọt Đan Mạch với nhiều vị trái cây'
        },
        {
            id: 24,
            name: 'Baguette',
            category: 'bread',
            price: 28000,
            icon: '🥖',
            description: 'Bánh mì Pháp truyền thống giòn rụm'
        }
    ];

    let cart = [];
    let currentCategory = 'all';
    let modalQuantity = 1;

    // Initialize
    function init() {
        displayProducts(products);
        updateCartCount();
    }

    // Display Products
    function displayProducts(productsToShow) {
        const grid = document.getElementById('productGrid');
        grid.innerHTML = '';

        productsToShow.forEach(product => {
            const card = document.createElement('div');
            card.className = 'product-card';
            card.innerHTML = `
        <div class="product-image">
            ${product.icon}
            ${product.badge ? `<span class="product-badge">${product.badge}</span>` : ''}
        </div>
        <div class="product-info">
            <h3>${product.name}</h3>
            <p class="product-description">${product.description}</p>
            <div class="product-footer">
                <div class="product-price">${formatPrice(product.price)}</div>
                <div class="product-actions">
                    <button class="action-btn view-btn" onclick="viewProduct(${product.id})"
                        title="Xem chi tiết">👁️</button>
                    <button class="action-btn cart-btn" onclick="quickAddToCart(${product.id})"
                        title="Thêm vào giỏ">🛒</button>
                </div>
            </div>
        </div>
        `;
            grid.appendChild(card);
        });
    }

    // Filter by Category
    function filterCategory(category) {
        currentCategory = category;

        // Update active tab
        const tabs = document.querySelectorAll('.category-tab');
        tabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');

        // Filter products
        const filtered = category === 'all' ?
            products :
            products.filter(p => p.category === category);

        displayProducts(filtered);
    }

    // View Product Detail
    function viewProduct(id) {
        const product = products.find(p => p.id === id);
        if (!product) return;

        modalQuantity = 1;
        const modal = document.getElementById('productModal');
        const modalBody = document.getElementById('modalBody');

        modalBody.innerHTML = `
        <div class="modal-product-image">${product.icon}</div>
        <h2 class="modal-product-title">${product.name}</h2>
        <div class="modal-product-price">${formatPrice(product.price)}</div>
        <p class="modal-product-description">${product.description}</p>

        <div class="quantity-selector">
            <span style="font-weight: 600;">Số lượng:</span>
            <button class="quantity-btn" onclick="decreaseQuantity()">−</button>
            <span class="quantity-display" id="modalQuantity">1</span>
            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
        </div>

        <button class="add-to-cart-btn" onclick="addToCartFromModal(${product.id})">
            🛒 Thêm Vào Giỏ Hàng
        </button>
        `;

        modal.classList.add('active');
    }

    // Close Modal
    function closeModal() {
        const modal = document.getElementById('productModal');
        modal.classList.remove('active');
        modalQuantity = 1;
    }

    // Quantity Controls
    function increaseQuantity() {
        modalQuantity++;
        document.getElementById('modalQuantity').textContent = modalQuantity;
    }

    function decreaseQuantity() {
        if (modalQuantity > 1) {
            modalQuantity--;
            document.getElementById('modalQuantity').textContent = modalQuantity;
        }
    }

    // Add to Cart from Modal
    function addToCartFromModal(id) {
        const product = products.find(p => p.id === id);
        if (!product) return;

        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity += modalQuantity;
        } else {
            cart.push({
                ...product,
                quantity: modalQuantity
            });
        }

        updateCartCount();
        showNotification();
        closeModal();
    }

    // Quick Add to Cart
    function quickAddToCart(id) {
        const product = products.find(p => p.id === id);
        if (!product) return;

        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
        }

        updateCartCount();
        showNotification();
    }

    // Update Cart Count
    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cartCount').textContent = count;
    }

    // Show Notification
    function showNotification() {
        const notification = document.getElementById('notification');
        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 2000);
    }

    // Format Price
    function formatPrice(price) {
        return price.toLocaleString('vi-VN') + 'đ';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Chatbox Functions
    function toggleChat() {
        const chatbox = document.getElementById('chatbox');
        chatbox.classList.toggle('active');
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    // Initialize on page load
    init();