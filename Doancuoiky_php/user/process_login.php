<?php
session_start();
require_once("../database/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Vui lòng nhập đầy đủ email và mật khẩu!'); window.history.back();</script>";
        exit;
    }

    $sql = "SELECT * FROM nguoi_dung WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<script>alert('Email không tồn tại!'); window.history.back();</script>";
        exit;
    }

    if ($password !== $user["mat_khau_hash"]) {
        echo "<script>alert('Mật khẩu không đúng!'); window.history.back();</script>";
        exit;
    }

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["ten_dang_nhap"];
    $_SESSION["role"] = $user["vai_tro"];

    if ($user["vai_tro"] == 1) {
        header("Location: ../admin/main.php");
        exit;
    } else if ($user["vai_tro"] == 2) {
        header("Location: ../admin/main.php");
        exit;
    } else if ($user["vai_tro"] == 3) {
        header("Location: trangchu.php");
        exit;
    } else {
        echo "<script>alert('Quyền không hợp lệ!'); window.history.back();</script>";
        exit;
    }
}
?>