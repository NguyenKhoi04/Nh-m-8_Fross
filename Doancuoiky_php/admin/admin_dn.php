<?php
session_start();
include("../database/connect.php"); 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu nhập từ form
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        try {
            // Chuẩn bị truy vấn với PDO để tránh SQL Injection
            $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :username AND mat_khau_hash = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $_SESSION["username"] = $username;
                header("Location: main.php");
                exit();
            } else {
                $error = "❌ Sai tên đăng nhập hoặc mật khẩu!";
            }
        } catch (PDOException $e) {
            $error = "Lỗi truy vấn: " . $e->getMessage();
        }
    } else {
        $error = "⚠️ Vui lòng nhập đầy đủ thông tin!";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống quản lý sách</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="login-page">
    <div class="modal-content">
        <h2 class="modal-title">ĐĂNG NHẬP HỆ THỐNG</h2>

        <?php if (!empty($error)): ?>
        <div class="error-message" style="color: red; text-align:center; margin-bottom:10px;">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- chuyển hướng trang chủ -->
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
            </div>

            <div style="text-align:center; ">
                <button type="submit" class="btn btn-submit">Đăng nhập</button>
                <!-- <button type="reset" class="btn btn-reset">Làm lại</button> -->
            </div>

            <!-- <div class="form-footer">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
            </div> -->
        </form>
    </div>
</body>

</html>