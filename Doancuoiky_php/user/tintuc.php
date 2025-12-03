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
    <?php include 'user_header.php'; ?>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1> Tin tức của CFPLUS</h1>
            <p>Những tin tức mới nhất về sản phẩm và chương trình khuyến mãi của chúng tôi</p>
        </div>
    </section>


    <section class="news-section">
        <h2 style="text-align:center; font-weight:bold;font-size:40px;">📰 Tin Tức Mới Nhất</h2>

        <div id="newsGrid" class="product-grid">
            <?php
            $stmt = $conn->query("SELECT * FROM tin_tuc ORDER BY id DESC");
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($news)) {
                echo '<p style="text-align:center;color:#999;font-style:italic;">Chưa có tin tức nào.</p>';
            } else {
                foreach ($news as $n) {

                    $imagePath = "../uploads/" . ($n['hinh_anh'] ?? '');
                    $hasImage = !empty($n['hinh_anh']) && file_exists($imagePath);
            ?>
            <div class="product-card">
                <div class="product-image">
                    <div
                        class="w-20 h-20 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 shadow-sm">

                        <?php if ($hasImage): ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($n['tieu_de']) ?>"
                            class="w-full h-full object-cover object-center">
                        <?php else: ?>
                        <div class="flex items-center justify-center w-full h-full text-gray-400 text-xs">
                            Không có ảnh
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="product-info">
                    <h3><?= htmlspecialchars($n['tieu_de']) ?></h3>

                    <div class="product-description">
                        <?= nl2br(htmlspecialchars($n['tom_tat'] ?? 'Không có tóm tắt')) ?>
                    </div>

                    <div class="product-footer">
                        <a href="chitiet_tintuc.php?id=<?= $n['id'] ?>" class="add-to-cart-btn"
                            style="text-decoration:none;">
                            📖 Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>

            <?php
                }
            }
            ?>
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