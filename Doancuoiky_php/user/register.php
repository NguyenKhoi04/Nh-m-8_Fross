<?php
session_start();
include("../database/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $repass = $_POST["repassword"];
    // $captcha_input = $_POST["captcha_input"];

    // // Kiểm tra CAPTCHA
    // if ($captcha_input !== $_SESSION["captcha"]) {
    //     die("<script>alert('Mã CAPTCHA không đúng!'); history.back();</script>");
    // }

    // Kiểm tra mật khẩu nhập lại
    if ($password !== $repass) {
        die("<script>alert('Mật khẩu không trùng khớp!'); history.back();</script>");
    }

    // Mã hoá mật khẩu
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Thêm vào bảng "nguoi_dung"
    $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau_hash, vai_tro)
            VALUES (?, ?, 3)";  // vai_tro = khách hàng

    $stm = $conn->prepare($sql);
    $stm->bind_param("ss", $username, $hash);

    if ($stm->execute()) {
        echo "<script>alert('Đăng ký thành công!'); window.location='login.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
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
            <h1>Chào Mừng Đến CFPLUS </h1>
            <p>Nơi hương vị cafe hòa quyện cùng bánh ngọt thơm ngon</p>
            <a href="#menu" class="cta-button">Khám Phá Thực Đơn</a>
        </div>
    </section>
    <section id="login-section">
        <div id="login-container">
            <h2 id="login-title">Đăng Ký Tài Khoản CFPLUS</h2>
            <form id="login-form" method="POST" action="register.php">
                <div id="form-group-username">
                    <label for="username">Email*</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên email của bạn" required>
                </div>

                <div id="form-group-password">
                    <label for="password">Mật khẩu *</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                </div>

                <div id="form-group-password">
                    <label for="repassword">Nhập lại mật khẩu *</label>
                    <input type="password" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu của bạn"
                        required>
                </div>

                <!-- <div id="form-group-password">
                    <img src="../captcha/captcha.php" onclick="this.src='../captcha/captcha.php?'+Math.random()"
                        style="cursor:pointer; margin-top:10px;">
                    <label for="captcha">Xác thực mã CAPTCHA*</label>
                    <input type="text" id="captcha" name="captcha_input" placeholder="Nhập mã CAPTCHA của bạn" required>
                </div> -->

                <button type="submit" id="login-button">
                    <img src="/img/login.png" alt="Đăng Ký"
                        style="height: 30px; width: 30px; vertical-align: middle; margin-right: 5px;">
                    Đăng ký
                </button>
            </form>

            <div id="social-login">
                <!-- <button id="facebook-login"> <img src="https://www.facebook.com/images/fb_icon_325x325.png"
                        alt="Facebook Logo">
                    Đăng nhập bằng Facebook</button> -->
                <button id="google-login"> <a
                        href="https://accounts.google.com/o/oauth2/auth?client_id=794484210721-if98l1699r4oek6s0f6qj0gip5legfnq.apps.googleusercontent.com&redirect_uri=http://caffeecfpluss.com/user/google_callback.php&scope=email profile&response_type=code">
                        <img src="/img/logogg.png"> Đăng nhập bằng Google
                    </a>
                </button>
            </div>
            <div id="login-hint">
                <span> Bạn đã có tài khoản? Bạn hãy <a href="login.php">Đăng nhập</a></span>
            </div>
    </section> <!-- Footer -->
    <?php include 'user_footer.php'; ?>