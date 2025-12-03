<?php
session_start();
require_once("../database/connect.php"); // file PDO

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {

        $email = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        if (empty($email) || empty($password)) {
            throw new Exception("Vui lòng nhập đầy đủ email và mật khẩu!");
        }

        // Chuẩn bị PDO
        $sql = "SELECT * FROM nguoi_dung 
                WHERE email = :email AND vai_tro = 3 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra email tồn tại
        if (!$user) {
            throw new Exception("Email không tồn tại hoặc không phải tài khoản người dùng!");
        }

        // So sánh mật khẩu plaintext
        if ($password !== $user["mat_khau_hash"]) {
            throw new Exception("Mật khẩu không đúng!");
        }

        // Lưu session
        $_SESSION["username"] = $user["ten_dang_nhap"];
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["vai_tro"];

        header("Location: trangchu.php");
        exit;

    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "'); window.history.back();</script>";
        exit;
    }
}
?>