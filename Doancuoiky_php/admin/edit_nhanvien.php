<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

if (!isset($_GET['id'])) {
    echo "Thiếu ID nhân viên.";
    exit();
}

$id = (int)$_GET['id'];
$success = "";
$error = "";

// Lấy thông tin nhân viên hiện tại
try {
    $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE id = :id AND vai_tro = 2");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $nhanvien = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$nhanvien) {
        echo "Không tìm thấy nhân viên.";
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

// Nếu người dùng bấm Cập nhật
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ho_ten = trim($_POST["ho_ten"]);
    $email = trim($_POST["email"]);
    $so_dien_thoai = trim($_POST["so_dien_thoai"]);

    if ($ho_ten == "" || $email == "" || $so_dien_thoai == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            $stmt = $conn->prepare("
                UPDATE nguoi_dung
                SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai
                WHERE id = :id
            ");
            $stmt->bindParam(":ho_ten", $ho_ten);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":so_dien_thoai", $so_dien_thoai);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $success = "Cập nhật thông tin nhân viên thành công!";
                // Cập nhật lại dữ liệu hiển thị
                $nhanvien["ho_ten"] = $ho_ten;
                $nhanvien["email"] = $email;
                $nhanvien["so_dien_thoai"] = $so_dien_thoai;
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
    <title>Sửa nhân viên</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h2>Sửa thông tin nhân viên</h2>

        <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="ho_ten">Họ và tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" class="form-control"
                    value="<?= htmlspecialchars($nhanvien['ho_ten']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($nhanvien['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control"
                    value="<?= htmlspecialchars($nhanvien['so_dien_thoai']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="list_nhanvien.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>