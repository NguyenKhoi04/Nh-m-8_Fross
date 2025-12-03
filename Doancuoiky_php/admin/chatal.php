<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ | Quản lý Cửa hàng cafe và bánh ngọt</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <!-- Thanh điều hướng -->
    <?php include 'header.php'; ?>
    <!-- Nội dung chính -->
    <div class="main-content">
        <h1>Chào mừng bạn đến với trang quản lý, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Chọn một tùy chọn từ thanh điều hướng để bắt đầu quản lý cửa hàng của bạn.</p>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>