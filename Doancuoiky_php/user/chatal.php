<?php
session_start();
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
    <?php include 'user_header.php'; ?>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Chào Mừng Đến CFPLUS </h1>
            <p>Nơi hương vị cafe hòa quyện cùng bánh ngọt thơm ngon</p>
            <a href="#menu" class="cta-button">Khám Phá Thực Đơn</a>
        </div>
    </section>
    <!-- Features Section -->
    <section class="features">
        <h2>Tại Sao Chọn Chúng Tôi?</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">☕</div>
                <h3>Cafe Chất Lượng</h3>
                <p>Hạt cafe được chọn lọc kỹ càng từ các vùng trồng nổi tiếng</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🍰</div>
                <h3>Bánh Ngọt Tươi Mới</h3>
                <p>Được làm mới mỗi ngày với nguyên liệu cao cấp</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚚</div>
                <h3>Giao Hàng Nhanh</h3>
                <p>Giao hàng tận nơi trong vòng 30 phút</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Giá Cả Hợp Lý</h3>
                <p>Chất lượng cao với mức giá phải chăng</p>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include 'user_footer.php'; ?>
    <!-- Chatbox -->
    <?php include 'user_chatbox.php'; ?>
</body>

</html>