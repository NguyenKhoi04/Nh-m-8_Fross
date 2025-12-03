<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php"); // $conn là PDO object

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn->beginTransaction();

        $idNguoiDung = $_POST["id_nguoi_dung"];
        $diaChiGiao = trim($_POST["dia_chi_giao"]);
        $trangThai = trim($_POST["trang_thai"]);
        $ghiChuGiaoHang = trim($_POST["ghi_chu_giao_hang"]);

        // 1️⃣ Thêm đơn hàng
        $sql = "INSERT INTO don_hang (id_nguoi_dung, dia_chi_giao, trang_thai, ghi_chu_giao_hang)
                VALUES (:id_nguoi_dung, :dia_chi_giao, :trang_thai, :ghi_chu_giao_hang)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":id_nguoi_dung" => $idNguoiDung,
            ":dia_chi_giao" => $diaChiGiao,
            ":trang_thai" => $trangThai,
            ":ghi_chu_giao_hang" => $ghiChuGiaoHang
        ]);
        $idDonHang = $conn->lastInsertId();

        // 2️⃣ Thêm chi tiết đơn hàng
        $idSanPham = $_POST["id_san_pham"];
        $soLuong = (int)$_POST["so_luong"];
        $donGia = (float)$_POST["don_gia"];
        $giamPhanTram = (float)$_POST["giam_phan_tram"];
        $ghiChu = trim($_POST["ghi_chu"]);

        $thanhTien = $soLuong * $donGia * (1 - $giamPhanTram / 100);

        $sqlCT = "INSERT INTO chi_tiet_don_hang (id_don_hang, id_san_pham, so_luong, don_gia, giam_phan_tram, thanh_tien, ghi_chu)
                  VALUES (:id_don_hang, :id_san_pham, :so_luong, :don_gia, :giam_phan_tram, :thanh_tien, :ghi_chu)";
        $stmtCT = $conn->prepare($sqlCT);
        $stmtCT->execute([
            ":id_don_hang" => $idDonHang,
            ":id_san_pham" => $idSanPham,
            ":so_luong" => $soLuong,
            ":don_gia" => $donGia,
            ":giam_phan_tram" => $giamPhanTram,
            ":thanh_tien" => $thanhTien,
            ":ghi_chu" => $ghiChu
        ]);

        $conn->commit();
        $message = "✅ Thêm đơn hàng thành công!";
    } catch (PDOException $e) {
        $conn->rollBack();
        $message = "❌ Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm đơn hàng | Quản lý Cửa hàng cafe và bánh ngọt</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h2>Thêm đơn hàng mới</h2>
        <?php if ($message) echo "<p style='color:blue;'>$message</p>"; ?>

        <form method="POST">
            <!-- Thông tin đơn hàng -->
            <div class="form-group">
                <label>Người dùng:</label>
                <select name="id_nguoi_dung" required>
                    <option value="">-- Chọn khách hàng --</option>
                    <?php
                    $users = $conn->query("SELECT id, ho_ten, ten_dang_nhap FROM nguoi_dung WHERE vai_tro = 3");
                    foreach ($users as $u) {
                        $ten = $u['ho_ten'] ?: $u['ten_dang_nhap'];
                        echo "<option value='{$u['id']}'>" . htmlspecialchars($ten) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Địa chỉ giao:</label>
                <textarea type="text" name="dia_chi_giao" required></textarea>
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="trang_thai">
                    <option value="Chờ xử lý">Chờ xử lý</option>
                    <option value="Đang giao">Đang giao</option>
                    <option value="Hoàn tất">Hoàn tất</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ghi chú giao hàng:</label>
                <textarea type="text" name="ghi_chu_giao_hang"></textarea>
            </div>

            <hr>

            <!-- Chi tiết sản phẩm -->
            <div class="form-group">
                <label>Sản phẩm:</label>
                <select name="id_san_pham" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php
                    $products = $conn->query("SELECT id, ten_san_pham, gia FROM san_pham");
                    foreach ($products as $p) {
                        echo "<option value='{$p['id']}'>" . htmlspecialchars($p['ten_san_pham']) . " - " . number_format($p['gia']) . "đ</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Số lượng:</label>
                <input type="number" name="so_luong" min="1" required>
            </div>

            <div class="form-group">
                <label>Đơn giá:</label>
                <input type="number" name="don_gia" min="0" step="100" required>
            </div>

            <div class="form-group">
                <label>Giảm giá (%):</label>
                <input type="number" name="giam_phan_tram" min="0" max="100" value="0">
            </div>

            <div class="form-group">
                <label>Ghi chú:</label>
                <textarea name="ghi_chu"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Thêm đơn hàng</button>
                <a href="list_dathang.php" class="btn btn-danger btn-sm">Quay lại</a>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>