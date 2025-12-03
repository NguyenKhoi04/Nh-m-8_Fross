<?php
session_start();
include("../database/connect.php");

// Lấy ID tin tức từ URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Tin tức không tồn tại!");
}
$id = intval($_GET['id']);

// Lấy dữ liệu tin tức
$stmt = $conn->prepare("SELECT * FROM tin_tuc WHERE id = :id LIMIT 1");
$stmt->bindValue(':id', $id);
$stmt->execute();
$tintuc = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tintuc) {
    die("Không tìm thấy tin tức!");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tintuc['tieu_de']) ?> | CFPLUS</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <!-- Header -->
    <?php include 'user_header.php'; ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1><?= htmlspecialchars($tintuc['tieu_de']) ?></h1>
            <p><?= htmlspecialchars($tintuc['tom_tat']) ?></p>
        </div>
    </section>

    <!-- ⭐ HIỂN THỊ CHI TIẾT TIN TỨC – đặt giữa HERO và FEATURES -->
    <section class="news-detail" style="padding:40px; max-width:900px; margin:auto;">

        <!-- Hình ảnh -->
        <?php if (!empty($tintuc['hinh_anh'])): ?>
        <div style="text-align:center; margin-bottom:20px;">
            <img src="../uploads/<?= htmlspecialchars($tintuc['hinh_anh']) ?>"
                alt="<?= htmlspecialchars($tintuc['tieu_de']) ?>" style="max-width:100%; border-radius:10px;">
        </div>
        <?php endif; ?>

        <!-- Nội dung HTML -->
        <div class="news-content" style="font-size:18px; line-height:1.6;">
            <?= $tintuc['noi_dung_html'] ?>
        </div>

        <!-- Nút quay lại -->
        <div style="text-align:center; margin-top:25px;">
            <a href="tintuc.php" style="display:inline-block; padding:10px 20px; 
                      background:#2563eb; color:#fff; border-radius:8px;
                      text-decoration:none;">
                ← Quay về danh sách tin tức
            </a>
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