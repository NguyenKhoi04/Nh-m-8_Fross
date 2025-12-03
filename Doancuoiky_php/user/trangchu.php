<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CFPLUS - Cafe & Bánh Ngọt</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
    /* Một số style nhanh nếu bạn chưa có toàn bộ CSS */
    .product-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .product-card {
        width: calc(25% - 1rem);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .product-image {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f7f7f7;
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .no-image {
        color: #999;
        font-size: 14px;
        padding: 1rem;
        text-align: center;
    }

    .product-info {
        padding: 0.75rem;
    }

    .product-info h3 {
        margin: 0 0 0.5rem 0;
        font-size: 16px;
    }

    .product-info p {
        margin: 0 0 .75rem 0;
        font-size: 13px;
        color: #555;
        min-height: 36px;
    }

    .product-price {
        font-weight: 700;
    }

    @media (max-width:900px) {
        .product-card {
            width: calc(50% - 1rem);
        }
    }

    @media (max-width:480px) {
        .product-card {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <!-- Header -->
    <?php
    session_start();
    include 'user_header.php';
    ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Chào Mừng Đến CFPLUS</h1>
            <p>Nơi hương vị cafe hòa quyện cùng bánh ngọt thơm ngon</p>
            <a href="thucdon.php" class="cta-button">Khám Phá Thực Đơn</a>
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

    <!-- Products Preview -->
    <section class="products-preview" id="menu">
        <h2>Sản phẩm nổi bật</h2>

        <?php
        // Kết nối đến cơ sở dữ liệu (file connect.php của bạn phải khởi tạo $conn là PDO)
        include("../database/connect.php");

        // Mảng khởi tạo products
        $featured = [];

        try {
            // Lấy tối đa 8 sản phẩm có noi_bat = 1
            $stmt = $conn->prepare("
                SELECT ten_san_pham, mo_ta, gia, hinh_anh
                FROM san_pham
                WHERE noi_bat = 1
                ORDER BY ten_san_pham ASC
                LIMIT 8
            ");
            $stmt->execute();
            $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Nếu cần, log $e->getMessage() vào file log ở môi trường production
            $featured = [];
        }
        ?>

        <div class="product-grid">
            <?php if (!empty($featured)): ?>
            <?php foreach ($featured as $item): ?>
            <div class="product-card">
                <div class="product-image">
                    <?php
                            if (!empty($item['hinh_anh'])) {
                                $imgPath = "../uploads/" . $item['hinh_anh'];
                                if (file_exists($imgPath)) {
                                    echo '<img src="' . htmlspecialchars($imgPath) . '" alt="' . htmlspecialchars($item['ten_san_pham']) . '">';
                                } else {
                                    // Nếu bạn lưu path đầy đủ trong DB, thử hiển thị trực tiếp
                                    if (@getimagesize($item['hinh_anh'])) {
                                        echo '<img src="' . htmlspecialchars($item['hinh_anh']) . '" alt="' . htmlspecialchars($item['ten_san_pham']) . '">';
                                    } else {
                                        echo '<div class="no-image">Không có ảnh</div>';
                                    }
                                }
                            } else {
                                echo '<div class="no-image">Không có ảnh</div>';
                            }
                            ?>
                </div>

                <div class="product-info">
                    <h3><?= htmlspecialchars($item['ten_san_pham']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($item['mo_ta'] ?? 'Không có mô tả')) ?></p>
                    <div class="product-price">
                        <?= number_format((float)($item['gia'] ?? 0), 0, ',', '.') ?> đ
                    </div>
                    <button class="add-to-cart-btn" onclick="window.location.href='thucdon.php'"
                        style="width: 160px;float: right; margin-left: 80px;">
                        Xem thực đơn
                    </button>

                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Chưa có sản phẩm nổi bật.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'user_footer.php'; ?>

    <!-- Chatbox -->
    <?php include 'user_chatbox.php'; ?>
</body>

</html>