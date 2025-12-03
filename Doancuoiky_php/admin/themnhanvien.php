<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");
$success = "";
$error = "";

// Nếu người dùng bấm Thêm nhân viên
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ten_dang_nhap = trim($_POST["ten_dang_nhap"]);
    $mat_khau = trim($_POST["mat_khau"]);
    $ho_ten = trim($_POST["ho_ten"]);
    $email = trim($_POST["email"]);
    $so_dien_thoai = trim($_POST["so_dien_thoai"]);

    if ($ten_dang_nhap == "" || $mat_khau == "" || $ho_ten == "" || $email == "" || $so_dien_thoai == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            // Kiểm tra trùng tên đăng nhập
            $check = $conn->prepare("SELECT id FROM nguoi_dung WHERE ten_dang_nhap = :tdn");
            $check->bindParam(":tdn", $ten_dang_nhap);
            $check->execute();

            if ($check->rowCount() > 0) {
                $error = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
            } else {
                $mat_khau_hash = password_hash($mat_khau, PASSWORD_BCRYPT);
                $vai_tro = 2; // nhân viên

                $stmt = $conn->prepare("
                    INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau_hash, ho_ten, email, so_dien_thoai, vai_tro, kich_hoat)
                    VALUES (:tdn, :mk, :ht, :em, :sdt, :vt, 1)
                ");
                $stmt->bindParam(":tdn", $ten_dang_nhap);
                $stmt->bindParam(":mk", $mat_khau_hash);
                $stmt->bindParam(":ht", $ho_ten);
                $stmt->bindParam(":em", $email);
                $stmt->bindParam(":sdt", $so_dien_thoai);
                $stmt->bindParam(":vt", $vai_tro, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $success = "Thêm nhân viên mới thành công!";
                } else {
                    $error = "Không thể thêm nhân viên. Vui lòng thử lại.";
                }
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
    <title>Thêm nhân viên</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h2>Thêm nhân viên mới</h2>

        <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="ten_dang_nhap">Tên đăng nhập:</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="mat_khau">Mật khẩu:</label>
                <input type="password" id="mat_khau" name="mat_khau" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ho_ten">Họ và tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
            <a href="list_nhanvien.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>