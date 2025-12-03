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
    <title>Trang chủ | Quản lý Cửa hàng cafe và bánh ngọt</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <!-- Thanh điều hướng -->
    <?php include 'header.php'; ?>

    <main class="container" style="max-width:700px; margin-top:40px;">
        <?php
        include("../database/connect.php");

        $edit_mode = false;
        $ten_san_pham = $gia = $mo_ta = $hinh_anh = $tinh_trang = '';
        $noi_bat = $moi = 0;
        $id_danh_muc = '';

        if (isset($_GET['id'])) {
            $edit_mode = false;
            $id = intval($_GET['id']);

            $sql = "SELECT * FROM san_pham WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $ten_san_pham = $row['ten_san_pham'];
                $gia = $row['gia'];
                $giam_gia = $row['giam_phan_tram'];
                $mo_ta = $row['mo_ta'];
                $hinh_anh = $row['hinh_anh'];
                $id_danh_muc = $row['id_danh_muc'];
                $tinh_trang = $row['tinh_trang'];
                $noi_bat = $row['noi_bat'];
                $moi = $row['moi'];
            }
        }
        ?>

        <h1 style="text-align:center; color:#2563eb;"><?php echo $edit_mode ? 'Sửa sản phẩm' : 'Thêm sản phẩm'; ?></h1>

        <form id="form_sanpham" action="" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
            <table class="table table-bordered" style="width:100%;">
                <tr>
                    <td><label for="ten_san_pham">Tên sản phẩm (*):</label></td>
                    <td><input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control"
                            value="<?php echo htmlspecialchars($ten_san_pham); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="gia">Giá (VNĐ):</label></td>
                    <td><input type="number" id="gia" name="gia" class="form-control" min="0"
                            value="<?php echo htmlspecialchars($gia); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="giam_gia">Giảm giá (%):</label></td>
                    <td><input type="number" id="giam_gia" name="giam_gia" class="form-control" min="0"
                            value="<?php echo htmlspecialchars($giam_gia); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="mo_ta">Mô tả:</label></td>
                    <td><textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"
                            required><?php echo htmlspecialchars($mo_ta); ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="id_danh_muc">Danh mục:</label></td>
                    <td>
                        <select id="id_danh_muc" name="id_danh_muc" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            $rs = $conn->query("SELECT id, ten_danh_muc FROM danh_muc");
                            while ($r = $rs->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($r['id'] == $id_danh_muc) ? "selected" : "";
                                echo "<option value='{$r['id']}' $selected>{$r['ten_danh_muc']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tinh_trang">Tình trạng:</label></td>
                    <td>
                        <select id="tinh_trang" name="tinh_trang" class="form-control" required>
                            <option value="con_hang" <?php if ($tinh_trang == 'con_hang') echo 'selected'; ?>>Còn hàng
                            </option>
                            <option value="het_hang" <?php if ($tinh_trang == 'het_hang') echo 'selected'; ?>>Hết hàng
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="noi_bat">Nổi bật:</label></td>
                    <td>
                        <label><input type="radio" id="noi_bat_1" name="noi_bat" value="1"
                                <?php if ($noi_bat == 1) echo 'checked'; ?>> Mở</label>
                        <label style="margin-left:20px;"><input type="radio" id="noi_bat_0" name="noi_bat" value="0"
                                <?php if ($noi_bat == 0) echo 'checked'; ?>> Đóng</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="moi">Mới:</label></td>
                    <td>
                        <label><input type="radio" id="moi_1" name="moi" value="1"
                                <?php if ($moi == 1) echo 'checked'; ?>> Mở</label>
                        <label style="margin-left:20px;"><input type="radio" id="moi_0" name="moi" value="0"
                                <?php if ($moi == 0) echo 'checked'; ?>> Đóng</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="hinh_anh">Hình ảnh:</label></td>
                    <td>
                        <?php if (!empty($hinh_anh)): ?>
                        <img id="preview_hinh_anh" src="../uploads/<?php echo htmlspecialchars($hinh_anh); ?>"
                            width="100" height="100" style="object-fit:cover;border-radius:5px;">
                        <br><small>Ảnh hiện tại</small><br>
                        <?php endif; ?>
                        <input type="file" id="hinh_anh" name="hinh_anh" accept="image/*" class="form-control mt-2">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align:right;">
                        <input type="submit" id="btnSave" name="btnSave"
                            value="<?php echo $edit_mode ? 'Cập nhật' : 'Thêm sản phẩm'; ?>" class="btn btn-primary">
                        <input type="reset" id="btnReset" value="Làm lại" class="btn btn-danger"
                            style="margin-left:10px;">
                    </td>
                </tr>
            </table>
        </form>

        <div style="text-align:center; margin-top:15px;">
            <a id="btnBack" href="list_sanpham.php" class="btn btn-danger btn-sm">🔙 Quay lại danh sách</a>
        </div>

        <?php
        if (isset($_POST['btnSave'])) {
            $ten_san_pham = trim($_POST['ten_san_pham']);
            $gia = floatval($_POST['gia']);
            $giam_gia = floatval($_POST['giam_gia']);
            $mo_ta = trim($_POST['mo_ta']);
            $id_danh_muc = intval($_POST['id_danh_muc']);
            $tinh_trang = $_POST['tinh_trang'];
            $noi_bat = isset($_POST['noi_bat']) ? intval($_POST['noi_bat']) : 0;
            $moi = isset($_POST['moi']) ? intval($_POST['moi']) : 0;

            // Upload ảnh
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

            // Nếu là thêm mới
            $sql = "INSERT INTO san_pham (ten_san_pham, gia, giam_phan_tram, mo_ta, hinh_anh, id_danh_muc, tinh_trang, noi_bat, moi)
                    VALUES (:ten_san_pham, :gia, :giam_phan_tram, :mo_ta, :hinh_anh, :id_danh_muc, :tinh_trang, :noi_bat, :moi)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':ten_san_pham', $ten_san_pham);
            $stmt->bindValue(':gia', $gia);
            $stmt->bindValue(':giam_phan_tram', $giam_gia);
            $stmt->bindValue(':mo_ta', $mo_ta);
            $stmt->bindValue(':hinh_anh', $new_image);
            $stmt->bindValue(':id_danh_muc', $id_danh_muc, PDO::PARAM_INT);
            $stmt->bindValue(':tinh_trang', $tinh_trang);
            $stmt->bindValue(':noi_bat', $noi_bat, PDO::PARAM_INT);
            $stmt->bindValue(':moi', $moi, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('✅ Thêm sản phẩm thành công!'); window.location='list_sanpham.php';</script>";
            } else {
                echo "<script>alert('❌ Lỗi khi thêm sản phẩm!');</script>";
            }
        }

        ?>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>