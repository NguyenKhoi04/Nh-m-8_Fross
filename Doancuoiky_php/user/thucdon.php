<?php
session_start();
include("../database/connect.php");

// --- Lấy danh mục cho Cột 2 ---
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmtCat = $conn->prepare("
        SELECT dm.id, dm.ten_danh_muc, COUNT(sp.id) AS so_san_pham
        FROM danh_muc dm
        LEFT JOIN san_pham sp ON dm.id = sp.id_danh_muc
        GROUP BY dm.id, dm.ten_danh_muc
    ");
    $stmtCat->execute();
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

    // --- Lấy các giá duy nhất cho Cột 3 ---
    $stmtPrice = $conn->prepare("SELECT DISTINCT gia FROM san_pham ORDER BY gia ASC");
    $stmtPrice->execute();
    $prices = $stmtPrice->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
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
    <?php include 'user_header.php'; ?>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Chào Mừng Đến Thực Đơn CFPLUS</h1>
            <p>Thực đơn đa dạng, phong phú cho bạn lựa chọn</p>
            <a href="thucdon.php" class="cta-button">Khám Phá Thực Đơn</a>
        </div>
    </section>

    <section class="menu-section" id="menu">
        <h2>📋 Thực Đơn Đặc Biệt</h2>

        <div class="menu-container">
            <div class="filter-row">

                <!-- CỘT 1: Mới / Nổi bật -->
                <div class="dropdown">
                    <button class="dropdown-btn">Tất Cả <span class="arrow">▾</span></button>
                    <div class="dropdown-list">
                        <div data-value="all" class="filter-btn" data-type="filter">Tất cả</div>
                        <div data-value="new" class="filter-btn" data-type="filter">Mới</div>
                        <div data-value="hot" class="filter-btn" data-type="filter">Nổi bật</div>
                    </div>
                </div>

                <!-- CỘT 2: Danh mục -->
                <div class="dropdown">
                    <button class="dropdown-btn">Danh Mục <span class="arrow">▾</span></button>
                    <div class="dropdown-list">
                        <div data-value="all" class="filter-btn" data-type="category">Tất cả</div>
                        <?php foreach ($categories as $cat): ?>
                        <div data-value="<?= htmlspecialchars($cat['id']) ?>" class="filter-btn" data-type="category">
                            <?= htmlspecialchars($cat['ten_danh_muc']) ?> (<?= $cat['so_san_pham'] ?>)
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- CỘT 3: Giá -->
                <div class="dropdown">
                    <button class="dropdown-btn">Chọn Giá <span class="arrow">▾</span></button>
                    <div class="dropdown-list">
                        <div data-value="all" class="filter-btn" data-type="price">Tất cả</div>
                        <?php foreach ($prices as $price): ?>
                        <div data-value="<?= $price ?>" class="filter-btn" data-type="price">
                            <?= number_format($price,0,',','.') ?> đ
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Product Grid -->
        <div id="productGrid" class="product-grid">
            <?php
            // Mặc định load tất cả sản phẩm lần đầu
            $stmt = $conn->query("SELECT sp.*, dm.ten_danh_muc FROM san_pham sp LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($products)){
                echo '<p style="text-align:center;color:#999;font-style:italic;">Không tìm thấy sản phẩm nào phù hợp.</p>';
            } else {
                foreach($products as $p){
                    $gia = $p['gia'];
                    $giam = $p['giam_gia'] ?? 0;
                    $gia_sau_giam = $gia - ($gia*$giam/100);
                    $badge = ($p['moi']==1)?"Mới":(($p['noi_bat']==1)?"Hot":"");
                    ?>
            <div class="product-card">
                <div class="product-image">
                    <?php 
                        $imagePath = "../uploads/" . ($p['hinh_anh'] ?? '');
                        $hasImage = !empty($p['hinh_anh']) && file_exists($imagePath);
                        ?>
                    <div
                        class="w-20 h-20 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 shadow-sm">
                        <?php if ($hasImage): ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($p['ten_san_pham']) ?>"
                            class="w-full h-full object-cover object-center">
                        <?php else: ?>
                        <div class="flex items-center justify-center w-full h-full text-gray-400 text-xs">
                            Không có ảnh
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if($giam>0) echo '<div class="product-discount">-'.$giam.'%</div>'; ?>
                    <?php if($badge) echo '<div class="product-badge">'.$badge.'</div>'; ?>
                </div>
                <div class="product-info">
                    <h3><?= htmlspecialchars($p['ten_san_pham']) ?></h3>
                    <div class="product-description"><?= htmlspecialchars($p['mo_ta'] ?? 'Không có mô tả') ?></div>
                    <div class="product-footer">
                        <div class="product-price">
                            <?php if($giam>0): ?>
                            <span class="old-price"><?= number_format($gia) ?> đ</span>
                            <span class="final-price"><?= number_format($gia_sau_giam) ?> đ</span>
                            <?php else: ?>
                            <span class="final-price"><?= number_format($gia) ?> đ</span>
                            <?php endif; ?>
                        </div>
                        <button class="add-to-cart-btn" data-id="<?= $p['id'] ?>">🛒Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>

    </section>

    <?php include 'user_footer.php'; ?>
    <?php include 'user_chatbox.php'; ?>
    <script src="/user/user.js"></script>

    <!-- JS AJAX lọc sản phẩm -->
    <script>
    const filters = {
        filter: 'all',
        category: 'all',
        price: 'all'
    };

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.type;
            const value = btn.dataset.value;
            filters[type] = value;

            // Fetch AJAX
            //nơi gọi đến file lọc sản phẩm trong file filter_products.php
            const params = new URLSearchParams(filters);
            fetch('/user/filter_products.php?' + params)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('productGrid').innerHTML = html;
                });
        });
    });

    // XỬ LÝ NÚT THÊM VÀO GIỎ HÀNG
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("add-to-cart-btn")) {
            const productId = e.target.dataset.id;

            fetch("/user/add_to_cart.php?id=" + productId)
                .then(res => res.json())
                .then(data => {
                    // Cập nhật số lượng giỏ hàng trên header
                    document.getElementById("cartCount").innerText = data.total;
                });
        }
    });
    </script>
</body>

</html>