<?php
session_start();

// Nếu không có dữ liệu checkout → quay về trang thực đơn
if (!isset($_SESSION['checkout_info'])) {
    header("Location: thucdon.php");
    exit;
}

$info = $_SESSION['checkout_info'];
unset($_SESSION['checkout_info']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đặt Hàng Thành Công | CFPLUS</title>
<link rel="stylesheet" href="../css/styles.css">

<style>

/* Tổng khung */
.thankyou-container {
    max-width: 880px;
    margin: 40px auto;
    padding: 25px 30px;
    background: #fff;
    border-radius: 10px;
    border: 1px solid #ddd;
}

/* 🎉 Tiêu đề */
.thankyou-title {
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    color: #2563eb;
    margin-bottom: 25px;
}

/* Nội dung chi tiết */
.details {
    background: #fefefe;
    padding: 18px 22px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 28px;
}

/* Label bôi đậm */
.details strong {
    color: #333;
}

/* Phần QR */
.qr-section {
    text-align: center;
    margin-top: 35px;
}

/* Dòng chữ QR */
.qr-section p {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 600;
    color: #444;
}

/* Ảnh QR */
.qr-section img {
    width: 260px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
}

/* Khoảng giữa QR và khung trên */
.qr-section {
    margin-top: 40px;
}

/* Responsive nhỏ */
@media (max-width: 600px) {
    .thankyou-title { font-size: 26px; }
    .qr-section img { width: 200px; }
}
</style>
</head>
<body>

<?php include 'user_header.php'; ?>

<div class="thankyou-container">

    <!-- 🎉 TIÊU ĐỀ -->
    <div class="thankyou-title">🎉 Cảm ơn bạn đã đặt hàng!</div>

    <!-- 📦 THÔNG TIN ĐƠN -->
    <div class="details">
        <p><strong>Tên người nhận:</strong> <?= htmlspecialchars($info['name']) ?></p>
        <p><strong>Địa chỉ nhận hàng:</strong> <?= htmlspecialchars($info['address']) ?></p>
        <p><strong>Ghi chú:</strong> <?= htmlspecialchars($info['notes']) ?: 'Không có' ?></p>
        <p><strong>Tổng thanh toán:</strong> <?= number_format($info['total'], 0, ',', '.') ?> đ</p>

        <p><strong>Phương thức thanh toán:</strong>
            <?= ($info['pay_method'] == 'cash') 
                ? 'Tiền mặt khi nhận hàng' 
                : 'Chuyển khoản (QR)' ?>
        </p>
    </div>

    <!-- 📷 QR CHỈ HIỆN KHI CHỌN BANK -->
    <?php if ($info['pay_method'] == 'bank'): ?>
    <div class="qr-section">
        <p>📱 Quét mã QR để thanh toán:</p>
        <img src="../uploads/payment_qr.png" alt="QR Thanh Toán">
    </div>
    <?php endif; ?>

</div>

<?php include 'user_footer.php'; ?>

</body>
</html>
