<?php
session_start();
include("../database/connect.php");

$filter   = $_GET['filter'] ?? 'all';
$category = $_GET['category'] ?? 'all';
$price    = $_GET['price'] ?? 'all';

$sql = "SELECT sp.*, dm.ten_danh_muc FROM san_pham sp 
        LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id WHERE 1=1 ";
$params = [];

if ($filter == 'new') {
    $sql .= " AND sp.moi = 1 ";
} elseif ($filter == 'hot') {
    $sql .= " AND sp.noi_bat = 1 ";
}
if ($category != 'all') {
    $sql .= " AND sp.id_danh_muc = :cat ";
    $params[':cat'] = $category;
}
if ($price != 'all') {
    $sql .= " AND sp.gia = :price ";
    $params[':price'] = $price;
}

$sql .= " ORDER BY sp.ten_san_pham ASC ";
$stmt = $conn->prepare($sql);
foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v);
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($products)) {
    echo '<p style="text-align:center;color:#999;">Không tìm thấy sản phẩm.</p>';
    exit;
}

foreach ($products as $p) {
    $id = $p['id'];
    $name = htmlspecialchars($p['ten_san_pham']);
    $price = number_format($p['gia'],0,',','.') . " đ";
    $img = htmlspecialchars($p['hinh_anh']);
    echo "
    <div class='product-card'>
        <div class='product-image'>
            <img src='../uploads/{$img}' alt='{$name}'>
        </div>
        <div class='product-info'>
            <h3>{$name}</h3>
            <div class='product-price'>{$price}</div>
            <button class='add-to-cart-btn' data-id='{$id}'>🛒 Thêm vào giỏ hàng</button>
        </div>
    </div>";
}