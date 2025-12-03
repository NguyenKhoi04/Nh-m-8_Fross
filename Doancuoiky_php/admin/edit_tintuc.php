<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin_dn.php");
    exit();
}

include("../database/connect.php");

// --- Lấy ID tin tức ---
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: list_tintuc.php");
    exit();
}

$id = $_GET['id'];

// --- Lấy dữ liệu tin tức từ DB ---
$sql = "SELECT * FROM tin_tuc WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$tintuc = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tintuc) {
    echo "<script>alert('Không tìm thấy tin tức!'); window.location='list_tintuc.php';</script>";
    exit();
}

// Gán dữ liệu cũ
$tieu_de = $tintuc['tieu_de'];
$tom_tat = $tintuc['tom_tat'];
$noi_dung = $tintuc['noi_dung_html'];
$hinh_anh_cu = $tintuc['hinh_anh'];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa tin tức | Quản lý Cửa hàng cafe</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="container" style="max-width:700px; margin-top:40px;">

        <h1 style="text-align:center; color:#2563eb;">Sửa tin tức</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered">

                <tr>
                    <td>Tiêu đề (*):</td>
                    <td>
                        <input type="text" name="tieu_de" class="form-control" value="<?= htmlspecialchars($tieu_de) ?>"
                            required>
                    </td>
                </tr>

                <tr>
                    <td>Tóm tắt:</td>
                    <td>
                        <textarea name="tom_tat" rows="3" class="form-control"
                            required><?= htmlspecialchars($tom_tat) ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Nội dung:</td>
                    <td>
                        <textarea name="noi_dung" rows="6" class="form-control"
                            required><?= htmlspecialchars($noi_dung) ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <?php if ($hinh_anh_cu != ""): ?>
                        <img src="../uploads/<?= $hinh_anh_cu ?>" width="120" style="margin-bottom:10px;"><br>
                        <?php endif; ?>
                        <input type="file" name="hinh_anh" accept="image/*">
                        <input type="hidden" name="hinh_anh_cu" value="<?= $hinh_anh_cu ?>">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td style="text-align:right;">
                        <input type="submit" name="btnUpdate" value="Cập nhật" class="btn btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <div style="text-align:center;margin-top:15px;">
            <a href="list_tintuc.php" class="btn btn-danger btn-sm">🔙 Quay lại danh sách</a>
        </div>

        <?php
// --- Xử lý cập nhật ---
if (isset($_POST['btnUpdate'])) {

    $tieu_de = trim($_POST['tieu_de']);
    $tom_tat = trim($_POST['tom_tat']);
    $noi_dung = trim($_POST['noi_dung']);

    // Ảnh cũ
    $hinh_anh = $_POST['hinh_anh_cu'];

    // Nếu có upload ảnh mới
    if (!empty($_FILES["hinh_anh"]["name"])) {

        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $img_name = basename($_FILES["hinh_anh"]["name"]);
        $target_file = $target_dir . $img_name;

        if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {
            $hinh_anh = $img_name; // Ghi đè bằng ảnh mới
        }
    }

    // Update database
    $sql = "UPDATE tin_tuc 
            SET tieu_de = :tieu_de,
                tom_tat = :tom_tat,
                noi_dung_html = :noi_dung,
                hinh_anh = :hinh_anh
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':tieu_de', $tieu_de);
    $stmt->bindValue(':tom_tat', $tom_tat);
    $stmt->bindValue(':noi_dung', $noi_dung);
    $stmt->bindValue(':hinh_anh', $hinh_anh);
    $stmt->bindValue(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location='list_tintuc.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật tin tức!');</script>";
    }
}
?>

    </main>

    <?php include 'footer.php'; ?>

</body>

</html>