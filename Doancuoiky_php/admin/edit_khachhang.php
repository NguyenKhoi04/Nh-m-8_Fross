<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

if (!isset($_GET['id'])) {
    echo "Thiếu ID khách hàng.";
    exit();
}

$id = (int) $_GET['id'];
$success = "";
$error = "";

try {
    $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE id = :id AND vai_tro = 3");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $khachhang = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$khachhang) {
        echo "Không tìm thấy khách hàng.";
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ho_ten = trim($_POST['ho_ten']);
    $email = trim($_POST['email']);
    $so_dien_thoai = trim($_POST['so_dien_thoai']);

    if ($ho_ten == "" || $email == "" || $so_dien_thoai == "") {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        try {
            $stmt = $conn->prepare("UPDATE nguoi_dung 
                                    SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai 
                                    WHERE id = :id AND vai_tro = 3");
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $success = "Cập nhật thông tin khách hàng thành công!";
                $khachhang['ho_ten'] = $ho_ten;
                $khachhang['email'] = $email;
                $khachhang['so_dien_thoai'] = $so_dien_thoai;
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
    <title>Sửa khách hàng</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main-content">
        <h2>Sửa thông tin khách hàng</h2>

        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Tên đăng nhập:</label>
                <input type="text" value="<?= htmlspecialchars($khachhang['ten_dang_nhap']) ?>" disabled>
            </div>

            <div class="form-group">
                <label for="ho_ten">Họ và tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" value="<?= htmlspecialchars($khachhang['ho_ten']) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($khachhang['email']) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="mat_khau">Mật khẩu:</label>
                <input type="text" id="mat_khau" name="mat_khau"
                    value="<?= htmlspecialchars($khachhang['mat_khau_hash']) ?>" required>
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai"
                    value="<?= htmlspecialchars($khachhang['so_dien_thoai']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="list_khachhang.php" class="btn btn-danger btn-sm">Quay lại</a>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>