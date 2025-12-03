<?php
session_start();
include("../database/connect.php");
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFPLUS - Cafe & Bánh Ngọt</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <!-- Header -->
    <header>
        <?php include 'user_header.php'; ?>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Giới thiệu cửa hàng CFPLUS </h1>
            <p>Khám phá hương vị tuyệt vời từ cafe và bánh ngọt của chúng tôi</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="about-container">
            <h2>🏪 Giới Thiệu</h2>

            <div class="about-hero">
                <div class="about-hero-content">
                    <h3>CFPLUS - Nơi Hương Vị Gặp Gỡ Đam Mê</h3>
                    <p>Từ năm 2015, chúng tôi đã mang đến những ly cafe thơm ngon và bánh ngọt tươi mới cho hàng ngàn
                        khách hàng tại TP.HCM</p>
                </div>
                <div class="about-hero-image">
                    <div class="about-image-box">☕🍰</div>
                </div>
            </div>

            <div class="story-section">
                <h3>📖 Câu Chuyện Của Chúng Tôi</h3>
                <div class="story-content">
                    <p>CFPLUS được thành lập với niềm đam mê mang đến những trải nghiệm cafe và bánh ngọt tuyệt vời
                        nhất. Chúng tôi bắt đầu từ một quán cafe nhỏ trên đường Nguyễn Huệ, và giờ đây đã phát triển
                        thành chuỗi cửa hàng được yêu thích tại Sài Gòn.</p>
                    <p>Mỗi sản phẩm của chúng tôi được chế biến tỉ mỉ từ những nguyên liệu cao cấp, kết hợp giữa công
                        thức truyền thống và sự sáng tạo hiện đại. Chúng tôi tin rằng mỗi ly cafe, mỗi chiếc bánh không
                        chỉ là thức uống hay món ăn, mà còn là nghệ thuật và tình yêu.</p>
                </div>
            </div>

            <div class="values-section">
                <h3>💎 Giá Trị Cốt Lõi</h3>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-icon">🌟</div>
                        <h4>Chất Lượng Hàng Đầu</h4>
                        <p>Chúng tôi chỉ sử dụng nguyên liệu cao cấp nhất, từ hạt cafe Arabica đến bơ Pháp, đường mía
                            hữu cơ và trứng gà tươi.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">❤️</div>
                        <h4>Tận Tâm Phục Vụ</h4>
                        <p>Đội ngũ nhân viên được đào tạo chuyên nghiệp, luôn sẵn sàng mang đến dịch vụ tốt nhất cho
                            khách hàng.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">🌱</div>
                        <h4>Bền Vững & Xanh</h4>
                        <p>Chúng tôi cam kết sử dụng bao bì thân thiện môi trường và hỗ trợ nông dân địa phương.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">🎨</div>
                        <h4>Sáng Tạo Không Ngừng</h4>
                        <p>Thực đơn luôn được cập nhật với những món mới độc đáo, kết hợp xu hướng và khẩu vị Việt.</p>
                    </div>
                </div>
            </div>

            <div class="achievements-section">
                <h3>🏆 Thành Tựu</h3>
                <div class="achievements-grid">
                    <div class="achievement-item">
                        <div class="achievement-number">10+</div>
                        <div class="achievement-label">Năm Kinh Nghiệm</div>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">5</div>
                        <div class="achievement-label">Chi Nhánh</div>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">50K+</div>
                        <div class="achievement-label">Khách Hàng Hài Lòng</div>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">100+</div>
                        <div class="achievement-label">Món Ăn & Đồ Uống</div>
                    </div>
                </div>
            </div>

            <div class="team-section">
                <h3>👥 Đội Ngũ Của Chúng Tôi</h3>
                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-avatar">👨‍🍳</div>
                        <h4>Chef Minh</h4>
                        <p class="team-role">Trưởng Bếp</p>
                        <p class="team-desc">15 năm kinh nghiệm, từng học tập tại Paris</p>
                    </div>
                    <div class="team-card">
                        <div class="team-avatar">👩‍💼</div>
                        <h4>Lan Anh</h4>
                        <p class="team-role">Quản Lý</p>
                        <p class="team-desc">Chuyên gia về quản lý F&B</p>
                    </div>
                    <div class="team-card">
                        <div class="team-avatar">👨‍🔬</div>
                        <h4>Barista Tuấn</h4>
                        <p class="team-role">Chuyên Gia Cafe</p>
                        <p class="team-desc">Vô địch Latte Art Việt Nam 2023</p>
                    </div>
                    <div class="team-card">
                        <div class="team-avatar">👩‍🍳</div>
                        <h4>Pastry Chef Mai</h4>
                        <p class="team-role">Chuyên Gia Bánh</p>
                        <p class="team-desc">Chứng chỉ Le Cordon Bleu</p>
                    </div>
                </div>
            </div>

            <div class="location-section">
                <h3>📍 Hệ Thống Cửa Hàng</h3>
                <div class="locations-grid">
                    <div class="location-card">
                        <div class="location-icon">🏪</div>
                        <h4>Chi Nhánh 1 - Quận 1</h4>
                        <p>123 Nguyễn Huệ, P. Bến Nghé, Q.1</p>
                        <p>📞 028 3822 xxxx</p>
                        <p>⏰ 7:00 - 22:00</p>
                    </div>
                    <div class="location-card">
                        <div class="location-icon">🏪</div>
                        <h4>Chi Nhánh 2 - Quận 3</h4>
                        <p>456 Nam Kỳ Khởi Nghĩa, Q.3</p>
                        <p>📞 028 3930 xxxx</p>
                        <p>⏰ 7:00 - 23:00</p>
                    </div>
                    <div class="location-card">
                        <div class="location-icon">🏪</div>
                        <h4>Chi Nhánh 3 - Quận 7</h4>
                        <p>789 Nguyễn Văn Linh, Q.7</p>
                        <p>📞 028 5412 xxxx</p>
                        <p>⏰ 6:30 - 22:30</p>
                    </div>
                </div>
            </div>

            <div class="cta-section">
                <h3>Ghé Thăm Chúng Tôi Ngay Hôm Nay!</h3>
                <p>Trải nghiệm hương vị tuyệt vời và không gian ấm cúng tại CFPLUS </p>
                <div class="cta-buttons">
                    <a href="thucdon.php" class="cta-button">Xem Thực Đơn</a>
                    <a href="lienhe.php" class="cta-button cta-button-outline">Liên Hệ</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <h3>CFPLUS Cafe & Bakery</h3>
            <p>📍 Địa chỉ: 123 Đường Nguyễn Huệ, Q.1, TP.HCM</p>
            <p>📞 Hotline: 1900 xxxx</p>
            <p>📧 Email: contact@sweetaroma.vn</p>
            <p>&copy; 2025 CFPLUS . All rights reserved.</p>
        </div>
    </footer>

    <!-- Chatbox -->
    <div class="chatbox-container">
        <button class="chat-button" onclick="toggleChat()">💬</button>
        <div class="chatbox" id="chatbox">
            <div class="chat-header">
                <h3>Hỗ Trợ Trực Tuyến</h3>
                <button class="close-chat" onclick="toggleChat()">×</button>
            </div>
            <div class="chat-messages" id="chatMessages">
                <div class="message bot">
                    Xin chào! Chào mừng bạn đến với CFPLUS . Tôi có thể giúp gì cho bạn?
                </div>
            </div>
            <div class="chat-input-container">
                <input type="text" class="chat-input" id="chatInput" placeholder="Nhập tin nhắn..."
                    onkeypress="handleKeyPress(event)">
                <button class="send-button" onclick="sendMessage()">Gửi</button>
            </div>
        </div>
    </div>

    <script>
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
                                <button class="action-btn view-btn" onclick="viewProduct(${product.id})" title="Xem chi tiết">👁️</button>
                                <button class="action-btn cart-btn" onclick="quickAddToCart(${product.id})" title="Thêm vào giỏ">🛒</button>
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

    function sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();

        if (message === '') return;

        const messagesContainer = document.getElementById('chatMessages');

        // Add user message
        const userMessage = document.createElement('div');
        userMessage.className = 'message user';
        userMessage.textContent = message;
        messagesContainer.appendChild(userMessage);

        input.value = '';
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Simulate bot response
        setTimeout(() => {
            const botMessage = document.createElement('div');
            botMessage.className = 'message bot';

            const lowerMessage = message.toLowerCase();
            if (lowerMessage.includes('giá') || lowerMessage.includes('bao nhiêu')) {
                botMessage.textContent =
                    'Giá các sản phẩm của chúng tôi dao động từ 28.000đ - 65.000đ. Bạn có thể xem chi tiết giá từng món trong thực đơn nhé!';
            } else if (lowerMessage.includes('menu') || lowerMessage.includes('thực đơn')) {
                botMessage.textContent =
                    'Chúng tôi có 4 danh mục: Cafe, Bánh Ngọt, Trà & Đồ Uống, và Bánh Mì. Mời bạn xem thực đơn phía trên!';
            } else if (lowerMessage.includes('giao hàng') || lowerMessage.includes('ship')) {
                botMessage.textContent =
                    'Chúng tôi giao hàng miễn phí trong bán kính 3km, thời gian giao hàng khoảng 30 phút. Phí ship 15.000đ cho khu vực xa hơn.';
            } else if (lowerMessage.includes('giờ') || lowerMessage.includes('mở cửa')) {
                botMessage.textContent =
                    'Cửa hàng mở cửa từ 7:00 sáng đến 10:00 tối hàng ngày. Chào đón bạn ghé thăm!';
            } else if (lowerMessage.includes('khuyến mãi') || lowerMessage.includes('giảm giá')) {
                botMessage.textContent =
                    'Hiện tại chúng tôi có chương trình giảm 10% cho đơn hàng từ 200.000đ. Và mua 2 tặng 1 cho các loại bánh ngọt vào thứ 7!';
            } else {
                botMessage.textContent =
                    'Cảm ơn bạn đã liên hệ! Nhân viên sẽ phản hồi trong giây lát. Hoặc bạn có thể gọi hotline: 1900 xxxx để được hỗ trợ nhanh hơn.';
            }

            messagesContainer.appendChild(botMessage);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 1000);
    }

    // Navigation between sections
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);

            // Hide all sections
            document.querySelectorAll('section').forEach(section => {
                if (section.id) {
                    section.style.display = 'none';
                }
            });

            // Show target section
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Show home/about section by default
    window.addEventListener('load', function() {
        const aboutSection = document.getElementById('about');
        if (aboutSection) {
            aboutSection.style.display = 'block';
        }
    });

    // Initialize on page load
    init();
    </script>
</body>

</html>