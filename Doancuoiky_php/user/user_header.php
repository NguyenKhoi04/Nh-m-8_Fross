<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tính tổng số lượng sản phẩm
$totalItems = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }
}
?>
<header>
    <nav class="nav-container">
        <div class="logo">☕ CFPLUS</div>
        <ul class="nav-links">
            <li><a href="trangchu.php">Trang Chủ</a></li>
            <li><a href="thucdon.php">Thực Đơn</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="lienhe.php">Liên Hệ</a></li>
            <li><a href="tintuc.php">Tin tức</a></li>

            <?php if (isset($_SESSION['user_name'])): ?>
            <li><a href="taikhoan.php">Xin chào, <?=htmlspecialchars($_SESSION['user_name'])?></a></li>
            <li><a href="logout.php">Đăng Xuất</a></li>
            <?php else: ?>
            <li><a href="user_login.php">Đăng Nhập</a></li>
            <?php endif; ?>
            <li>
                <div class="cart-icon"
                    onclick="window.location.href='<?= isset($_SESSION['user_id']) ? 'chitietgiohang.php' : 'user_login.php' ?>'">
                    🛒
                    <span class="cart-count" id="cartCount"><?= $totalItems ?></span>
                </div>
            </li>

        </ul>
    </nav>
</header>