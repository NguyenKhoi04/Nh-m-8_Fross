<?php
session_start();

// nếu chưa có cart thì chuyển về
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// tính tổng tiền
$totalAmount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalAmount += ($item['gia'] * $item['quantity']);
}

$name = "";
$address = "";
$notes = "";
$pay_method = "cash";

// xử lý POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name       = trim($_POST['receiver_name'] ?? '');
    $address    = trim($_POST['delivery_address'] ?? '');
    $notes      = trim($_POST['delivery_notes'] ?? '');
    $pay_method = $_POST['pay_method'] ?? 'cash';

    // lưu dữ liệu để sang trang thankyou
    $_SESSION['checkout_info'] = [
        'name' => $name,
        'address' => $address,
        'notes' => $notes,
        'pay_method' => $pay_method,
        'total' => $totalAmount
    ];

    // chuyển sang trang thankyou
    header("Location: thankyou.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán | CFPLUS</title>
    <link rel="stylesheet" href="../css/styles.css">

    <style>
    .checkout-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .checkout-form-group {
        margin: 15px 0;
    }

    .checkout-form-group label {
        font-weight: bold;
    }

    .checkout-form-group input,
    .checkout-form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    .checkout-option {
        margin: 15px 0;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .total-price {
        text-align: right;
        font-size: 20px;
        font-weight: bold;
    }

    .confirm-btn {
        width: 100%;
        padding: 12px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 18px;
        margin-top: 20px;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <?php include 'user_header.php'; ?>

    <div class="checkout-container">
        <h2>Thanh Toán Đơn Hàng</h2>

        <p class="total-price">
            Tổng thanh toán: <strong><?= number_format($totalAmount, 0, ',', '.') ?> đ</strong>
        </p>

        <form method="POST" action="">

            <div class="checkout-form-group">
                <label for="receiver_name">👤 Tên người nhận:</label>
                <input type="text" name="receiver_name" id="receiver_name" required
                    value="<?= htmlspecialchars($name) ?>">
            </div>

            <div class="checkout-form-group">
                <label for="delivery_address">📍 Địa chỉ nhận hàng:</label>
                <input type="text" name="delivery_address" id="delivery_address" required
                    value="<?= htmlspecialchars($address) ?>">
            </div>

            <div class="checkout-form-group">
                <label for="delivery_notes">📝 Ghi chú (tùy chọn):</label>
                <textarea name="delivery_notes" id="delivery_notes"><?= htmlspecialchars($notes) ?></textarea>
            </div>

            <div class="checkout-option">
                <label>
                    <input type="radio" name="pay_method" value="cash" <?= ($pay_method == 'cash') ? 'checked' : '' ?>>
                    Thanh toán khi nhận hàng (Tiền mặt)
                </label>
            </div>
            <div class="checkout-option">
                <label>
                    <input type="radio" name="pay_method" value="bank" <?= ($pay_method == 'bank') ? 'checked' : '' ?>>
                    Thanh toán chuyển khoản (QR)
                </label>
            </div>

            <button type="submit" class="confirm-btn">Xác Nhận Thanh Toán</button>

        </form>
    </div>

    <?php include 'user_footer.php'; ?>

</body>

</html>