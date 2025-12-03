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
    <title>Thêm tin tức | Quản lý Cửa hàng cafe và bánh ngọt</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <!-- Thanh điều hướng -->
    <?php include 'header.php'; ?>

    <main class="container" style="max-width:700px; margin-top:40px;">
        <?php
        include("../database/connect.php");

        // biến mặc định
        $tieu_de = $tom_tat = $noi_dung = $hinh_anh = "";
        ?>

        <h1 style="text-align:center; color:#2563eb;">Thêm tin tức mới</h1>

        <form id="form_tintuc" action="" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
            <table class="table table-bordered" style="width:100%">

                <tr>
                    <td><label for="tieu_de">Tiêu đề (*):</label></td>
                    <td><input type="text" id="tieu_de" name="tieu_de" class="form-control"
                            value="<?php echo htmlspecialchars($tieu_de); ?>" required></td>
                </tr>

                <tr>
                    <td><label for="tom_tat">Tóm tắt:</label></td>
                    <td><textarea id="tom_tat" name="tom_tat" class="form-control" rows="3"
                            required><?php echo htmlspecialchars($tom_tat); ?></textarea></td>
                </tr>

                <tr>
                    <td><label for="noi_dung">Nội dung:</label></td>
                    <td><textarea id="noi_dung" name="noi_dung" class="form-control" rows="6"
                            required><?php echo htmlspecialchars($noi_dung); ?></textarea></td>
                </tr>

                <tr>
                    <td><label for="hinh_anh">Hình ảnh:</label></td>
                    <td>
                        <input type="file" id="hinh_anh" name="hinh_anh" accept="image/*" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td style="text-align:right;">
                        <input type="submit" id="btnSave" name="btnSave" value="Thêm tin tức" class="btn btn-primary">
                        <input type="reset" id="btnReset" value="Làm lại" class="btn btn-danger"
                            style="margin-left:10px;">
                    </td>
                </tr>
            </table>
        </form>

        <div style="text-align:center; margin-top:15px;">
            <a id="btnBack" href="list_tintuc.php" class="btn btn-danger btn-sm">🔙 Quay lại danh sách</a>
        </div>

        <?php
        // Xử lý khi nhấn nút lưu
        if (isset($_POST['btnSave'])) {
            $tieu_de = trim($_POST['tieu_de']);
            $tom_tat = trim($_POST['tom_tat']);
            $noi_dung = trim($_POST['noi_dung']); 

            // xử lý hình ảnh
            $target_dir = "../uploads/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

            $new_image = "";
            if (!empty($_FILES["hinh_anh"]["name"])) {
                $img_name = basename($_FILES["hinh_anh"]["name"]);
                $target_file = $target_dir . $img_name;

                if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {
                    $new_image = $img_name;
                }
            }

            // lưu database
            $sql = "INSERT INTO tin_tuc (tieu_de, tom_tat, noi_dung_html, hinh_anh)
                    VALUES (:tieu_de, :tom_tat, :noi_dung, :hinh_anh)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':tieu_de', $tieu_de);
            $stmt->bindValue(':tom_tat', $tom_tat);
            $stmt->bindValue(':noi_dung', $noi_dung);  
            $stmt->bindValue(':hinh_anh', $new_image);

            if ($stmt->execute()) {
                echo "<script>alert('Thêm tin tức thành công!'); window.location='list_tintuc.php';</script>";
            } else {
                echo "<script>alert('Lỗi khi thêm tin tức!');</script>";
            }
        }

        ?>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>