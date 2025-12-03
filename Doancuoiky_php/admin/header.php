<!-- Thanh điều hướng -->
<header class="sidebar">
    <div class="sidebar-content">
        <div class="logo">
            🍽️ Hệ thống Quản lý <br><b>Cửa hàng cafe và bánh ngọt</b>
        </div>

        <ul class="nav-menu">
            <li><a href="main.php">🏠 Trang chủ</a></li>
            <!-- Nhóm: Quản lý hàng hóa -->
            <li class="dropdown">
                <button class="dropdown-btn">📋 Quản lý hàng hóa</button>
                <ul class="dropdown-content">
                    <li><a href="list_sanpham.php">🍽️QL Sản phẩm</a></li>
                    <li><a href="list_danhmucgia.php">💰 QL phân loại giá</a></li>
                    <li><a href="list_danhmucsanpham.php">📂 QL danh mục sản phẩm</a></li>
                </ul>
            </li>

            <!-- Nhóm: Quản lý người dùng -->
            <li class="dropdown">
                <button class="dropdown-btn">👥 Quản lý người dùng</button>
                <ul class="dropdown-content">
                    <li><a href="list_nhanvien.php">👨‍🍳 Nhân viên</a></li>
                    <li><a href="list_khachhang.php">👤 Khách hàng</a></li>
                    <li><a href="list_khachhang.php"> 🕒Lịch sử đăng nhập</a></li>
                    <li><a href="list_khachhang.php"> 📲Danh sách liên hệ</a></li>
                </ul>
            </li>
            <li><a href="thongkebaocao.php">📊 Thống kê báo cáo </a></li>
            <li><a href="list_dathang.php">📅 Quản lý đặt hàng</a></li>
            <li><a href="chatal.php">🤖 ChatAL</a></li>
            <!-- Nhóm: Quản lý đánh giá -->
            <li class="dropdown">
                <button class="dropdown-btn">⭐ Quản lý đánh giá </button>
                <ul class="dropdown-content">
                    <li><a href="danhgiasanpham.php">📝 QL đánh giá sản phẩm</a></li>
                    <li><a href="danhgiacuahang.php">📝 QL gửi tin nhắn từ trang Tin tức</a></li>
                </ul>
            </li>
            <li><a href="xulythanhtoan.php">💵 QL thanh toán</a></li>
            <li><a href="list_tintuc.php">📰 Quản lý tin tức</a></li>
        </ul>

        <div class="auth-section">
            <span>Xin chào, <b><?php echo htmlspecialchars($username); ?></b></span>
            <form method="POST" action="logout.php">
                <button class="btn-logout" type="submit">Đăng xuất</button>
            </form>
        </div>
    </div>
</header>