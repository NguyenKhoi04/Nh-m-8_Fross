<?php
session_start();
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
                    <input type="text" id="username" name="username" placeholder="Nhập email của bạn" required>
                </div>
                <div id="form-group-password">
                    <label for="password">Mật khẩu*</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                </div>
                <!-- <div id="form-group-password">
                    <label for="password">Xác thực mã CAPTCHA*</label>
                    <input type="password" id="password" placeholder="Nhập mã CAPTCHA của bạn" required>
                </div> -->
                <button type="submit" id="login-button"><img src="/Doancuoiky_php/img/login.png" alt="Đăng Nhập"
                        style="height: 30px; width: 30px; display: inline-block; vertical-align: middle; margin-right: 5px;">Đăng
                    nhập</button>
            </form>
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