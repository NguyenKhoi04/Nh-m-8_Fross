<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
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
    <?php include 'user_header.php'; ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Chào Mừng Đến CFPLUS</h1>
            <p>Nơi hương vị cafe hòa quyện cùng bánh ngọt thơm ngon</p>
            <a href="#menu" class="cta-button">Khám Phá Thực Đơn</a>
        </div>
    </section>

    <section style="margin: 20px;">
        <h2 style="text-align:center; font-weight: bold; font-size: 40px;">🛒 Chi tiết giỏ hàng</h2>

        <?php if (empty($cart)) : ?>

        <p style="text-align:center; color:#FF0000; font-size: 25px;">Giỏ hàng trống</p>

        <?php else: ?>

        <table class="cart-table">
            <tr>
                <th>STT</th>
                <th>Hình</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>

            <?php
                $tong = 0;
                $stt  = 1;

                foreach ($cart as $item):
                    $thanhtien = $item['gia'] * $item['quantity'];
                    $tong     += $thanhtien;
                ?>

            <tr data-id="<?= $item['id'] ?>">
                <td><?= $stt++ ?></td>

                <td>
                    <img src="../uploads/<?= $item['hinh_anh'] ?>" width="60">
                </td>

                <td><?= $item['ten_san_pham'] ?></td>

                <td><?= number_format($item['gia']) ?> đ</td>

                <td>
                    <button class="qty-btn minus">-</button>
                    <span class="qty"><?= $item['quantity'] ?></span>
                    <button class="qty-btn plus">+</button>
                </td>

                <td class="subtotal"><?= number_format($thanhtien) ?> đ</td>

                <td>
                    <button class="remove-btn" title="Xóa sản phẩm">🗑</button>
                </td>
            </tr>

            <?php endforeach; ?>

        </table>

        <h3 style="text-align:right; margin-right:20px;">
            Tổng cộng: <span id="totalPrice"><?= number_format($tong) ?> đ</span>
        </h3>

        <div style="text-align:right; margin-right:20px;">
            <a href="thanhtoan.php" class="checkout-btn">XÁC NHẬN THANH TOÁN</a>
        </div>

        <?php endif; ?>
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

    <script>
    document.addEventListener("click", function(e) {

        if (e.target.classList.contains("plus")) {
            updateQty(e.target.closest("tr").dataset.id, "plus");
        }

        if (e.target.classList.contains("minus")) {
            updateQty(e.target.closest("tr").dataset.id, "minus");
        }

        if (e.target.classList.contains("remove-btn")) {
            updateQty(e.target.closest("tr").dataset.id, "remove");
        }
    });

    function updateQty(id, action) {
        fetch(`/user/update_cart.php?id=${id}&action=${action}`)
            .then(res => res.json())
            .then(() => location.reload());
    }
    </script>

</body>

</html>