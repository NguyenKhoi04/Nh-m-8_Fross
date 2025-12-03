<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ | Quản lý Cửa hàng cafe và bánh ngọt</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="admin.js" defer></script>
</head>

<body>

    <!-- Thanh điều hướng -->
    <?php include 'header.php'; ?>
    <!-- Banner giới thiệu -->
    <section class="hero-banner">
        <div class="hero-content">
            <h1>Chào mừng đến với Hệ thống Cửa hàng cafe và bánh ngọt</h1>
            <p>Dễ dàng thêm, chỉnh sửa và quản lý cửa hàng của bạn</p>
            <a href="list_monan.php" class="btn btn-hero">Bắt đầu quản lý</a>
        </div>
    </section>
    <!-- Danh mục sách -->
    <section class="container">
        <h2 class="section-title">Danh mục sản phẩm nổi bật</h2>
        <div class="categories">
            <?php
            include("../database/connect.php");
            //dùng PDO thay cho mysqli
            try {
                $stmt = $conn->query("SELECT ten_danh_muc FROM danh_muc");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if ($result) {
                                foreach ($result as $row) {
                                    echo '
                                    <div class="category-card">
                                        <div class="category-title">' . htmlspecialchars($row['ten_danh_muc']) . '</div>
                                    </div>';
                                }
                            } else {
                                echo "<p>Chưa có chủ đề nào được thêm.</p>";
                            }
                        } catch (PDOException $e) {
                            echo "Lỗi truy vấn: " . $e->getMessage();
                        }
                        ?>
        </div>
    </section>

    <!-- $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
→ $result là mảng các dòng dữ liệu, không phải kết quả truy vấn của mysqli.

!empty($result) kiểm tra xem có dữ liệu không.

foreach ($result as $row) duyệt từng dòng. -->

    <!-- Món ăn nổi bật -->
    <section class="container featured-products">
        <h2 class="section-title">Thực đơn nổi bật</h2>
        <div class="products-grid">
            <?php
            include("../database/connect.php");

            try {
                // Truy vấn 8 sản phẩm đầu tiên
                $sql = "SELECT * FROM san_pham";
                $stmt = $conn->query($sql); // dùng PDO thay cho mysqli_query
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // lấy tất cả kết quả

                // Duyệt và hiển thị từng sản phẩm
                foreach ($result as $row) {
                // Kiểm tra đường dẫn ảnh
                $imagePath = '../uploads/' . $row['hinh_anh'];

                // Nếu không có ảnh hoặc file không tồn tại → dùng ảnh mặc định
                if (empty($row['hinh_anh']) || !file_exists($imagePath)) {
                    $imagePath = '../uploads/no-image.png'; // ảnh mặc định
                }

                echo '
                <div class="product-card">
                    <div class="product-image">
                        <img src="' . htmlspecialchars($imagePath) . '" 
                            alt="' . htmlspecialchars($row['ten_san_pham']) . '">
                    </div>
                    <div class="product-info">
                        <div class="product-title">' . htmlspecialchars($row['ten_san_pham']) . '</div>
                        <div class="product-price">' . number_format($row['gia']) . '₫</div>
                        <button class="btn btn-add-to-cart">Chi tiết</button>
                    </div>
                </div>';
}


            } catch (PDOException $e) {
                echo "❌ Lỗi truy vấn: " . $e->getMessage();
            }
            ?>

        </div>
    </section>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>