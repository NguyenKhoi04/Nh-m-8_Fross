<?php
session_start();
include 'includes/db_connect.php';

$client_id = "794484210721-if98l1699r4oek6s0f6qj0gip5legfnq.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/google_callback.php";

if (isset($_GET['code'])) {

    // Lấy token từ Google
    $token = file_get_contents(
        "https://oauth2.googleapis.com/token",
        false,
        stream_context_create([
            "http" => [
                "method" => "POST",
                "header" => "Content-Type: application/x-www-form-urlencoded",
                "content" => http_build_query([
                    "code" => $_GET['code'],
                    "client_id" => $client_id,
                    "client_secret" => $client_secret,
                    "redirect_uri" => $redirect_uri,
                    "grant_type" => "authorization_code"
                ])
            ]
        ])
    );

    $token = json_decode($token, true);

    // Lấy thông tin người dùng
    $userInfo = json_decode(
        file_get_contents("https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $token['access_token']),
        true
    );

    $email = $userInfo['email'];
    $name = $userInfo['name'];

    // Kiểm tra email đã tồn tại?
    $check = $conn->query("SELECT * FROM nguoi_dung WHERE email='$email'");
    
    if ($check->num_rows == 0) {
        // Nếu chưa có → tự động tạo tài khoản
        $conn->query("INSERT INTO nguoi_dung (ten_nguoi_dung, email, vai_tro)
                      VALUES ('$name', '$email', 3)");
    }

    $_SESSION["user"] = $name;
    header("Location: index.php");
    exit();
}
?>