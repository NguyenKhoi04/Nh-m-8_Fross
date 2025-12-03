<?php
session_start();
include("../database/connect.php");

$filter = $_GET['filter'] ?? 'all';
$category = $_GET['category'] ?? 'all';
$price = $_GET['price'] ?? 'all';

$sql = "SELECT sp.*, dm.ten_danh_muc FROM san_pham sp LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id WHERE 1=1";

// Lọc Mới / Nổi bật
if ($filter === "new") $sql .= " AND sp.moi = 1";
if ($filter === "hot") $sql .= " AND sp.noi_bat = 1";

// Lọc danh mục
if ($category !== "all") $sql .= " AND sp.id_danh_muc = " . intval($category);

// Lọc giá
if ($price !== "all") $sql .= " AND sp.gia = " . intval($price);

$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($products)) {
    echo '<p style="text-align:center;color:#999;font-style:italic;">Không tìm thấy sản phẩm nào phù hợp.</p>';
} else {
    foreach ($products as $p) {
        $gia = $p['gia'];
        $giam = $p['giam_gia'] ?? 0;
        $gia_sau_giam = $gia - ($gia * $giam / 100);
        $badge = ($p['moi'] == 1) ? "Mới" : (($p['noi_bat'] == 1) ? "Hot" : "");

        // Đường dẫn ảnh
        $imagePath = "../uploads/" . ($p['hinh_anh'] ?? '');
        $hasImage = !empty($p['hinh_anh']) && file_exists($imagePath);

        echo '<div class="product-card">
                <div class="product-image">
                    <div class="w-32 h-32 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 shadow-sm">';
        if ($hasImage) {
            echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($p['ten_san_pham']) . '" class="w-full h-full object-cover object-center">';
        } else {
            echo '<div class="flex items-center justify-center w-full h-full text-gray-400 text-xs">
                    Không có ảnh
                  </div>';
        }
        echo '</div>';

        if ($giam > 0) echo '<div class="product-discount">-' . $giam . '%</div>';
        if ($badge) echo '<div class="product-badge">' . $badge . '</div>';

        echo '</div>
            <div class="product-info">
                <h3>' . htmlspecialchars($p['ten_san_pham']) . '</h3>
                <div class="product-description">' . htmlspecialchars($p['mo_ta'] ?? 'Không có mô tả') . '</div>
                <div class="product-footer">
                    <div class="product-price">';
        if ($giam > 0) {
            echo '<span class="old-price">' . number_format($gia) . ' đ</span>
                  <span class="final-price">' . number_format($gia_sau_giam) . ' đ</span>';
        } else {
            echo '<span class="final-price">' . number_format($gia) . ' đ</span>';
        }
        echo '</div>
              <button class="add-to-cart-btn" data-id="' . $p['id'] . '">🛒 Thêm vào giỏ hàng</button>
              </div>
            </div>
          </div>';
    }
}
?>