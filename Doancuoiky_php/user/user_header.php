<header>
    <nav>
        <div class="logo">☕ CFPLUS </div>
        <ul class="nav-links">
            <li><a href="trangchu.php">Trang Chủ</a></li>
            <li><a href="thucdon.php">Thực Đơn</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="lienhe.php">Liên Hệ</a></li>
            <li><a href="tintuc.php">Tin tức</a></li>

            <?php
            if (isset($_SESSION['username'])) {
                echo '<li><a href="taikhoan.php">Xin chào, ' . htmlspecialchars($_SESSION['username']) . '</a></li>';
                echo '<li><a href="../user/logout.php">Đăng Xuất</a></li>';
            } else {
                echo '<li><a href="user_login.php">Đăng Nhập</a></li>';
            }
            ?>

            <!-- <?php
// chỉ hiển thị "Xin chào" và "Đăng Xuất" khi vai_tro = 3 (không cho vai_tro = 1 hoặc 2)
// if (isset($_SESSION['username']) && isset($_SESSION['vai_tro']) && (int)$_SESSION['vai_tro'] === 3) {
//     echo '<li><a href="taikhoan.php">Xin chào, ' . htmlspecialchars($_SESSION['username']) . '</a></li>';
//     echo '<li><a href="/user/logout.php">Đăng Xuất</a></li>';
// } else {
//     echo '<li><a href="/user/user_login.php">Đăng Nhập</a></li>';
// }
?> -->

            <li>
                <div class="cart-icon"
                    onclick="window.location.href='<?= isset($_SESSION['user_id']) ? 'chitietgiohang.php' : '/user/user_login.php' ?>'">
                    🛒
                    <span class="cart-count" id="cartCount">
                        <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    </span>
                </div>
            </li>

        </ul>
    </nav>
</header>