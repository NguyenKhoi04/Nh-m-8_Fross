<?php
session_start();

// Nếu chưa có cart hoặc trống → redirect về thucdon
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $cartItems = [];
} else {
    $cartItems = $_SESSION['cart'];
}

// Xử lý cập nhật số lượng nếu form gửi lên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['quantity'] as $id => $qty) {
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
    header("Location: cart.php");
    exit;
}

// Tính tổng tiền
$total = 0;
foreach ($cartItems as $item) {
    $total += ($item['gia'] * $item['quantity']);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng | CFPLUS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/styles.css">

    <style>
        .cart-container { max-width:1000px; margin:40px auto; padding:20px; background:#fff; border-radius:8px; }
        .cart-container h2 { font-size:24px; text-align:center; margin-bottom:20px; color:#333; }
        .cart-table { width:100%; border-collapse:collapse; margin-bottom:20px; }
        .cart-table th, .cart-table td { padding:12px 10px; border-bottom:1px solid #ddd; text-align:center; }
        .cart-table img { width:70px; height:auto; border-radius:6px; }
        .cart-actions input { width:60px; padding:6px; text-align:center; }
        .btn-update, .btn-checkout, .btn-remove {
            padding:10px 18px; border:none; border-radius:6px; cursor:pointer; font-size:14px;
        }
        .btn-update { background:#2563eb; color:#fff; }
        .btn-checkout { background:#28a745; color:#fff; margin-top:10px; float:right; }
        .btn-remove { background:#dc3545; color:#fff; }
        .total-price { text-align:right; font-size:20px; font-weight:bold; margin-top:10px; }
    </style>
</head>
<body>

<?php include 'user_header.php'; ?>

<div class="cart-container">

    <h2>🛒 Giỏ Hàng Của Bạn</h2>

    <?php if (empty($cartItems)): ?>
        <p style="text-align:center; font-size:18px; color:#555;">Giỏ hàng đang trống!</p>
        <p style="text-align:center;"><a href="thucdon.php" class="btn-update" style="background:#333;color:#fff;">Quay Lại Thực Đơn</a></p>
    <?php else: ?>

    <form method="POST" action="cart.php">

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $id => $item): ?>
                <?php
                    $img = htmlspecialchars($item['hinh_anh']);
                    $name = htmlspecialchars($item['ten_san_pham']);
                    $gia = number_format($item['gia'],0,',','.') . " đ";
                    $qty = intval($item['quantity']);
                    $subtotal = number_format($item['gia'] * $qty,0,',','.') . " đ";
                ?>
                <tr>
                    <td><img src="../uploads/<?= $img ?>" alt="<?= $name ?>"></td>
                    <td><?= $name ?></td>
                    <td><?= $gia ?></td>
                    <td class="cart-actions">
                        <input type="number" name="quantity[<?= $id ?>]" value="<?= $qty ?>" min="1">
                    </td>
                    <td><?= $subtotal ?></td>
                    <td>
                        <a href="remove_cart.php?id=<?= $id ?>" class="btn-remove">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" class="btn-update">Cập nhật giỏ hàng</button>

    </form>

    <div class="total-price">
        Tổng: <?= number_format($total,0,',','.') ?> đ
    </div>

    <a href="thanhtoan.php" class="btn-checkout">Thanh toán</a>

    <?php endif; ?>

</div>

<?php include 'user_footer.php'; ?>

</body>
</html>
