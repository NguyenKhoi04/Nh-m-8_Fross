<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");
$message = "";

$idDonHang = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idDonHang <= 0) {
    die("ID đơn hàng không hợp lệ.");
}

// --- Lấy thông tin đơn hàng và chi tiết ---
$sql = "SELECT dh.*, ctdh.id_san_pham, ctdh.so_luong, ctdh.don_gia, ctdh.giam_phan_tram, ctdh.ghi_chu
        FROM don_hang dh
        JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
        WHERE dh.id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $idDonHang]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Không tìm thấy đơn hàng.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn->beginTransaction();

        $diaChiGiao = $_POST["dia_chi_giao"];
        $trangThai = $_POST["trang_thai"];
        $ghiChuGiaoHang = $_POST["ghi_chu_giao_hang"];

        $sql = "UPDATE don_hang 
                SET dia_chi_giao = :dia_chi_giao, trang_thai = :trang_thai, ghi_chu_giao_hang = :ghi_chu_giao_hang
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":dia_chi_giao" => $diaChiGiao,
            ":trang_thai" => $trangThai,
            ":ghi_chu_giao_hang" => $ghiChuGiaoHang,
            ":id" => $idDonHang
        ]);

        // --- Cập nhật chi tiết ---
        $idSanPham = $_POST["id_san_pham"];
        $soLuong = (int)$_POST["so_luong"];
        $donGia = (float)$_POST["don_gia"];
        $giamPhanTram = (float)$_POST["giam_phan_tram"];
        $ghiChu = $_POST["ghi_chu"];
        $thanhTien = $soLuong * $donGia * (1 - $giamPhanTram / 100);

        $sqlCT = "UPDATE chi_tiet_don_hang
                  SET id_san_pham = :id_san_pham, so_luong = :so_luong, don_gia = :don_gia, giam_phan_tram = :giam_phan_tram,
                      thanh_tien = :thanh_tien, ghi_chu = :ghi_chu
                  WHERE id_don_hang = :id_don_hang";
        $stmtCT = $conn->prepare($sqlCT);
        $stmtCT->execute([
            ":id_san_pham" => $idSanPham,
            ":so_luong" => $soLuong,
            ":don_gia" => $donGia,
            ":giam_phan_tram" => $giamPhanTram,
            ":thanh_tien" => $thanhTien,
            ":ghi_chu" => $ghiChu,
            ":id_don_hang" => $idDonHang
        ]);

        $conn->commit();
        $message = "✅ Cập nhật đơn hàng thành công!";
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
    <title>Sửa đơn hàng</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h2>Sửa đơn hàng</h2>
        <?php if ($message) echo "<p style='color:blue;'>$message</p>"; ?>

        <form method="POST">
            <!-- Thông tin đơn hàng -->
            <div class="form-group">
                <label>Địa chỉ giao:</label>
                <textarea type="text" name="dia_chi_giao"
                    required><?php echo htmlspecialchars($order['dia_chi_giao']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="trang_thai">
                    <?php
                    $options = ["Chờ xử lý", "Đang giao", "Hoàn tất"];
                    foreach ($options as $opt) {
                        $sel = ($opt == $order['trang_thai']) ? "selected" : "";
                        echo "<option $sel>$opt</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Ghi chú giao hàng:</label>
                <textarea name="ghi_chu_giao_hang"
                    rows="3"><?php echo htmlspecialchars($order['ghi_chu_giao_hang']); ?></textarea>
            </div>

            <hr>
            <h3>Chi tiết sản phẩm</h3>

            <div class="form-group">
                <label>Sản phẩm:</label>
                <select name="id_san_pham" required>
                    <?php
                    $products = $conn->query("SELECT id, ten_san_pham FROM san_pham");
                    foreach ($products as $p) {
                        $sel = ($p['id'] == $order['id_san_pham']) ? "selected" : "";
                        echo "<option value='{$p['id']}' $sel>" . htmlspecialchars($p['ten_san_pham']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Số lượng:</label>
                <input type="number" name="so_luong" min="1" value="<?php echo htmlspecialchars($order['so_luong']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Đơn giá:</label>
                <input type="number" name="don_gia" step="100"
                    value="<?php echo htmlspecialchars($order['don_gia']); ?>" required>
            </div>

            <div class="form-group">
                <label>Giảm giá (%):</label>
                <input type="number" name="giam_phan_tram" min="0" max="100"
                    value="<?php echo htmlspecialchars($order['giam_phan_tram']); ?>">
            </div>

            <div class="form-group">
                <label>Ghi chú sản phẩm:</label>
                <textarea name="ghi_chu" rows="3"><?php echo htmlspecialchars($order['ghi_chu']); ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="list_dathang.php" class="btn btn-danger btn-sm">Quay lại</a>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>