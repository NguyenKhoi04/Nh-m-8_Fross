<?php
session_start();
include("../database/connect.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// nếu chưa có cart thì tạo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// lấy sản phẩm từ db
$stmt = $conn->prepare("SELECT * FROM san_pham WHERE id = :id LIMIT 1");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $product['id'],
            'ten_san_pham' => $product['ten_san_pham'],
            'gia' => $product['gia'],
            'hinh_anh' => $product['hinh_anh'],
            'quantity' => 1
        ];
    }
}

// tính tổng số lượng để gửi về header
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['quantity'];
}

echo json_encode(['status' => 'ok', 'total' => $total]);