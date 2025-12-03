<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFPLUS - Cafe & Bánh Ngọt</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <!-- Header -->
    <header>
        <?php include 'user_header.php'; ?>
    </header>


    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Liên hệ cửa hàng CFPLUS </h1>
            <p>Khám phá hương vị tuyệt vời từ cafe và bánh ngọt của chúng tôi</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class=" contact-container">
            <h2>📞 Liên Hệ Với Chúng Tôi</h2>
            <p class="contact-subtitle">Chúng tôi luôn sẵn sàng lắng nghe và phục vụ bạn</p>
            <div class="contact-content">
                <div class="contact-info-section">
                    <h3>Thông Tin Liên Hệ</h3>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">📍</div>
                        <div class="contact-info-details">
                            <h4>Địa Chỉ Trụ Sở</h4>
                            <p>123 Đường Nguyễn Huệ, Phường Bến Nghé</p>
                            <p>Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">📞</div>
                        <div class="contact-info-details">
                            <h4>Số Điện Thoại</h4>
                            <p>Hotline: 1900 xxxx</p>
                            <p>Hỗ trợ: 028 3822 xxxx</p>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">📧</div>
                        <div class="contact-info-details">
                            <h4>Email</h4>
                            <p>contact@sweetaroma.vn</p>
                            <p>support@sweetaroma.vn</p>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">⏰</div>
                        <div class="contact-info-details">
                            <h4>Giờ Làm Việc</h4>
                            <p>Thứ 2 - Thứ 6: 7:00 - 22:00</p>
                            <p>Thứ 7 - CN: 6:30 - 23:00</p>
                        </div>
                    </div>
                    <div class="contact-social">
                        <h4>Kết Nối Với Chúng Tôi</h4>
                        <div class="contact-social-links">
                            <a href="#" class="contact-social-btn" title="Facebook"
                                aria-label="Follow us on Facebook">📘</a>
                            <a href="#" class="contact-social-btn" title="Instagram"
                                aria-label="Follow us on Instagram">📷</a>
                            <a href="#" class="contact-social-btn" title="Twitter"
                                aria-label="Follow us on Twitter">🐦</a>
                            <a href="#" class="contact-social-btn" title="YouTube"
                                aria-label="Subscribe to our YouTube">📺</a>
                            <a href="#" class="contact-social-btn" title="Zalo" aria-label="Contact us on Zalo">💬</a>
                        </div>
                    </div>
                </div>
                <div class="contact-form-section">
                    <h3>Gửi Tin Nhắn Cho Chúng Tôi</h3>
                    <form class="contact-form" id="contactForm" onsubmit="handleContactSubmit(event)">
                        <div class="form-group">
                            <label for="fullName" class="form-label">Họ và Tên *</label>
                            <input type="text" id="fullName" class="form-input" placeholder="Nhập họ và tên của bạn"
                                required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" id="email" class="form-input" placeholder="email@example.com"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Số Điện Thoại *</label>
                                <input type="tel" id="phone" class="form-input" placeholder="0912 345 678" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Chủ Đề *</label>
                            <select id="subject" class="form-select" required>
                                <option value="">-- Chọn chủ đề --</option>
                                <option value="order">Đặt Hàng</option>
                                <option value="feedback">Góp Ý / Phản Hồi</option>
                                <option value="complaint">Khiếu Nại</option>
                                <option value="partnership">Hợp Tác Kinh Doanh</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Nội Dung *</label>
                            <textarea id="message" class="form-textarea" rows="6"
                                placeholder="Nhập nội dung tin nhắn của bạn..." required></textarea>
                        </div>
                        <button type="submit" class="form-submit-btn">📤 Gửi Tin Nhắn</button>
                    </form>
                </div>
            </div>
            <div class="contact-map-section">
                <h3>🗺️ Bản Đồ Địa Điểm</h3>
                <div class="contact-map-container">
                    <div class="contact-map-placeholder">
                        <div class="map-icon">📍</div>
                        <p>123 Nguyễn Huệ, Quận 1, TP.HCM</p>
                        <p class="map-note">Google Maps sẽ được tích hợp tại đây</p>
                    </div>
                </div>
            </div>
            <div class="contact-faq-section">
                <h3>❓ Câu Hỏi Thường Gặp</h3>
                <div class="faq-grid">
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Làm sao để đặt hàng trực tuyến?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Bạn có thể đặt hàng qua website bằng cách chọn sản phẩm, thêm vào giỏ hàng và thanh toán.
                            Hoặc gọi hotline 1900 xxxx để đặt hàng qua điện thoại.
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Thời gian giao hàng là bao lâu?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Thời gian giao hàng trung bình là 30-45 phút trong bán kính 5km. Đối với khu vực xa hơn,
                            thời gian có thể kéo dài thêm 15-30 phút.
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Có hỗ trợ thanh toán online không?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Có, chúng tôi hỗ trợ thanh toán qua thẻ ATM, thẻ tín dụng, ví điện tử (MoMo, ZaloPay, VNPay)
                            và thanh toán khi nhận hàng (COD).
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Có chương trình khuyến mãi nào không?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Chúng tôi thường xuyên có các chương trình khuyến mãi. Theo dõi fanpage và website để cập
                            nhật thông tin mới nhất. Hiện tại đang giảm 10% cho đơn từ 200.000đ!
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Làm thế nào để trở thành đối tác?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Vui lòng gửi email đến contact@sweetaroma.vn hoặc gọi 028 3822 xxxx để được tư vấn về chương
                            trình hợp tác kinh doanh.
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span>Có nhận đặt tiệc/sự kiện không?</span>
                            <span class="faq-toggle">+</span>
                        </button>
                        <div class="faq-answer">
                            Có, chúng tôi nhận đặt tiệc cho các sự kiện từ 20-200 người. Vui lòng liên hệ trước ít nhất
                            3 ngày để được tư vấn menu và báo giá.
                        </div>
                    </div>
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
    </section>
    <script>
    // FAQ Toggle
    function toggleFAQ(element) {
        const faqItem = element.closest('.faq-item');
        faqItem.classList.toggle('active');
    }

    // Contact Form Submission
    function handleContactSubmit(event) {
        event.preventDefault();
        alert('Tin nhắn đã được gửi! Chúng tôi sẽ liên hệ lại sớm.');
        document.getElementById('contactForm').reset();
    }
    </script>
    <!-- Footer -->
    <?php include 'user_footer.php'; ?>
    <!-- Chatbox -->
    <?php include 'user_chatbox.php'; ?>
</body>

</html>