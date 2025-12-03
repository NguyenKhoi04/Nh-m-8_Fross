<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

$success = "";
$error = "";

// Nếu nhấn nút Thêm mới
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_danh_muc = trim($_POST['ten_danh_muc']);
    $loai = trim($_POST['loai']);

    if ($ten_danh_muc == "" || $loai == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            // Thêm danh mục mới vào CSDL
            $stmt = $conn->prepare("INSERT INTO danh_muc (ten_danh_muc, loai, ngay_tao) VALUES (:ten_danh_muc, :loai, NOW())");
            $stmt->bindParam(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindParam(':loai', $loai);

            if ($stmt->execute()) {
                $success = "Thêm danh mục mới thành công!";
            } else {
                $error = "Không thể thêm danh mục. Vui lòng thử lại.";
            }
        } catch (PDOException $e) {
            $error = "Lỗi: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm danh mục</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h2>Thêm danh mục sản phẩm</h2>

        <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="ten_danh_muc">Tên danh mục:</label>
                <input type="text" id="ten_danh_muc" name="ten_danh_muc" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="id_loai">Loại danh mục:</label>
                <select id="id_loai" name="loai" class="form-control" required>
                    <option value="">-- Chọn loại --</option>
                    <option value="do_uong">Đồ uống</option>
                    <option value="trang_mieng">Tráng miệng</option>
                    <option value="banh_ngot">Bánh ngọt</option>
                    <option value="ca_phe">Cà phê</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
            <a href="list_danhmucsanpham.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>