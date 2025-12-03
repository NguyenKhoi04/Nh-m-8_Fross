<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

if (!isset($_GET['id'])) {
    echo "Thiếu ID danh mục.";
    exit();
}

$id = (int) $_GET['id'];
$success = "";
$error = "";

// Lấy thông tin danh mục hiện tại
try {
    $stmt = $conn->prepare("SELECT * FROM danh_muc WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $danhmuc = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$danhmuc) {
        echo "Không tìm thấy danh mục.";
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

// Nếu nhấn nút cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_danh_muc = trim($_POST['ten_danh_muc']);
    $loai = trim($_POST['loai']);

    if ($ten_danh_muc == "" || $loai == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            $stmt = $conn->prepare("UPDATE danh_muc SET ten_danh_muc = :ten_danh_muc, loai = :loai WHERE id = :id");
            $stmt->bindParam(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindParam(':loai', $loai);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $success = "Cập nhật danh mục thành công!";
                // Cập nhật lại dữ liệu hiển thị
                $danhmuc['ten_danh_muc'] = $ten_danh_muc;
                $danhmuc['loai'] = $loai;
            } else {
                $error = "Cập nhật thất bại.";
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
    <title>Sửa danh mục</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main-content">
        <h2>Sửa danh mục sản phẩm</h2>

        <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="ten_danh_muc">Tên danh mục:</label>
                <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                    value="<?= htmlspecialchars($danhmuc['ten_danh_muc']) ?>" required>
            </div>

            <div class="form-group">
                <label for="id_loai">Loại danh mục:</label>
                <select id="id_loai" name="loai" class="form-control" required>
                    <option value="do_uong" <?= $danhmuc['loai'] == 'do_uong' ? 'selected' : '' ?>>Đồ uống</option>
                    <option value="trang_mieng" <?= $danhmuc['loai'] == 'trang_mieng' ? 'selected' : '' ?>>Tráng miệng
                    </option>
                    <option value="banh_ngot" <?= $danhmuc['loai'] == 'banh_ngot' ? 'selected' : '' ?>>Bánh ngọt
                    </option>
                    <option value="ca_phe" <?= $danhmuc['loai'] == 'ca_phe' ? 'selected' : '' ?>>Cà phê</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="list_danhmucsanpham.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>