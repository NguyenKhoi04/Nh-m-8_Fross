<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_dang_nhap = trim($_POST['ten_dang_nhap']);
    $ho_ten = trim($_POST['ho_ten']);
    $email = trim($_POST['email']);
    $so_dien_thoai = trim($_POST['so_dien_thoai']);
    $mat_khau = trim($_POST['mat_khau']);

    if ($ten_dang_nhap == "" || $ho_ten == "" || $email == "" || $so_dien_thoai == "" || $mat_khau == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            // Kiểm tra trùng tên đăng nhập
            $check = $conn->prepare("SELECT COUNT(*) FROM nguoi_dung WHERE ten_dang_nhap = :ten_dang_nhap");
            $check->bindParam(':ten_dang_nhap', $ten_dang_nhap);
            $check->execute();
            if ($check->fetchColumn() > 0) {
                $error = "Tên đăng nhập đã tồn tại!";
            } else {
                $mat_khau_hash = password_hash($mat_khau, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau_hash, ho_ten, email, so_dien_thoai, vai_tro, kich_hoat)
                                        VALUES (:ten_dang_nhap, :mat_khau_hash, :ho_ten, :email, :so_dien_thoai, 3, 1)");
                $stmt->bindParam(':ten_dang_nhap', $ten_dang_nhap);
                $stmt->bindParam(':mat_khau_hash', $mat_khau_hash);
                $stmt->bindParam(':ho_ten', $ho_ten);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);

                if ($stmt->execute()) {
                    $success = "Thêm khách hàng thành công!";
                } else {
                    $error = "Thêm thất bại!";
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
    <title>Thêm khách hàng</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main-content">
        <h2>Thêm khách hàng mới</h2>

        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="ten_dang_nhap">Tên đăng nhập:</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" required>
            </div>

            <div class="form-group">
                <label for="mat_khau">Mật khẩu:</label>
                <input type="password" id="mat_khau" name="mat_khau" required>
            </div>

            <div class="form-group">
                <label for="ho_ten">Họ và tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm khách hàng</button>
            <a href="list_khachhang.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>