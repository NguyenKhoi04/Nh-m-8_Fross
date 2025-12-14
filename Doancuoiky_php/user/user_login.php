<?php
session_start();
include("../database/connect.php");

$error = "";

// Xử lý form POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if ($email == "" || $password == "") {
        $error = "⚠️ Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE email = :email LIMIT 1");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password === $user['mat_khau_hash']) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['ho_ten'];
                $_SESSION['user_role'] = $user['vai_tro'];

                // Remember me bằng cookie (lưu email)
                if ($remember) {
                    setcookie("remember_email", $email, time() + (86400 * 30), "/");
                } else {
                    setcookie("remember_email", "", time() - 3600, "/");
                }

                header("Location: trangchu.php");
                exit;
            } else {
                $error = "❌ Sai email hoặc mật khẩu!";
            }
        } catch (PDOException $e) {
            $error = "❌ Lỗi truy vấn: " . $e->getMessage();
        }
    }
}

// lấy giá trị remember từ cookie
$rememberEmail = $_COOKIE['remember_email'] ?? "";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFPLUS - Cafe & Bánh Ngọt</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <!-- Header -->
    <header>
        <?php include 'user_header.php'; ?>
    </header>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Chào Mừng Đến CFPLUS </h1>
            <p>Nơi hương vị cafe hòa quyện cùng bánh ngọt thơm ngon</p>
            <a href="#menu" class="cta-button">Khám Phá Thực Đơn</a>
        </div>
    </section>
    <section id="login-section">
        <div id="login-container">
            <h2 id="login-title">Đăng Nhập Tài Khoản CFPLUS </h2>
            <form id="login-form" action="process_login.php" method="POST">

                <div id="form-group-username">
                    <label for="username">Email*</label>
                    <input type="text" id="username" name="username" placeholder="Nhập email của bạn"
                        value="<?= htmlspecialchars($rememberEmail) ?>" required>
                </div>
                <div id="form-group-password">
                    <label for="password">Mật khẩu*</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="rememberMe" <?= $rememberEmail ? "checked" : "" ?>>
                    <label for="rememberMe">Ghi nhớ tài khoản</label>
                </div>
                <!-- <div id="form-group-password">
                    <label for="password">Xác thực mã CAPTCHA*</label>
                    <input type="password" id="password" placeholder="Nhập mã CAPTCHA của bạn" required>
                </div> -->
                <button type="submit" id="login-button"><img src="/Doancuoiky_php/img/login.png" alt="Đăng Nhập"
                        style="height: 30px; width: 30px; display: inline-block; vertical-align: middle; margin-right: 5px;">Đăng
                    nhập</button>
            </form>
            <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <div id="social-login">
                <!-- <button id="facebook-login"> <img src="https://www.facebook.com/images/fb_icon_325x325.png"
                        alt="Facebook Logo">
                    Đăng nhập bằng Facebook</button> -->
                <button id="google-login"> <a
                        href="https://accounts.google.com/o/oauth2/auth?client_id=794484210721-if98l1699r4oek6s0f6qj0gip5legfnq.apps.googleusercontent.com&redirect_uri=http://caffeecfpluss.com/user/google_callback.php&scope=email profile&response_type=code">
                        <img src="/Doancuoiky_php/img/logogg.png"> Đăng nhập bằng Google
                    </a>
                </button>
            </div>
            <div id="login-hint">
                <span> Bạn chưa có tài khoản? Bạn hãy <a href="register.php">Đăng ký</a></span>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include 'user_footer.php'; ?>
</body>