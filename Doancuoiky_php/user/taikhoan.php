<?php
session_start();

// Kiểm tra đăng nhập và vai trò khách
if (!isset($_SESSION['username']) || (int)($_SESSION['vai_tro'] ?? 0) !== 3) {
    header("Location: user_login.php");
    exit();
}

// Lấy thông tin người dùng từ session (có thể thay bằng truy vấn DB nếu cần)
$username = $_SESSION['username'];
$email = $_SESSION['email'] ?? 'Chưa cập nhật';
$phone = $_SESSION['so_dien_thoai'] ?? 'Chưa cập nhật';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Tài Khoản - CFPLUS</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f7f7f7;
        margin: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .info {
        margin: 20px 0;
    }

    .info p {
        margin: 10px 0;
        font-size: 16px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background: #ff6600;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        background: #e65c00;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Xin chào, <?= htmlspecialchars($username) ?></h2>

        <div class="info">
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($phone) ?></p>
            <p><strong>Vai trò:</strong> Khách hàng</p>
        </div>

        <div class="actions">
            <a href="capnhat_taikhoan.php" class="btn">Cập nhật thông tin</a>
            <a href="doi_matkhau.php" class="btn">Đổi mật khẩu</a>
        </div>
    </div>

</body>

</html>