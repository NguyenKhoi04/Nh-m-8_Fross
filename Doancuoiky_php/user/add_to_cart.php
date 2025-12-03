<?php
session_start();
include("../database/connect.php");

$id = $_GET['id'] ?? 0;
$id = intval($id);

// Nếu giỏ hàng chưa tồn tại → tạo mảng rỗng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Kiểm tra sản phẩm trong database
$stmt = $conn->prepare("SELECT * FROM san_pham WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    // Nếu sản phẩm đã có → tăng số lượng
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        // Nếu chưa có → thêm mới
        $_SESSION['cart'][$id] = [
            'id' => $product['id'],
            'ten_san_pham' => $product['ten_san_pham'],
            'gia' => $product['gia'],
            'hinh_anh' => $product['hinh_anh'],
            'quantity' => 1
        ];
    }
}

// Tính tổng số món trong giỏ (không phải số loại sản phẩm)
// $totalItems = 0;
// foreach ($_SESSION['cart'] as $item) {
//     $totalItems += $item['quantity'];
// }
//Tính tổng số loại sản phẩm trong giỏ không phải tồng quantity

$total = count($_SESSION['cart']);  // chỉ đếm số sản phẩm


// Trả về JSON
echo json_encode(['total' => $total]);
?>