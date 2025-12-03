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
    <!-- Nội dung chính -->
    <div class="main-content">
        <h1>Chào mừng bạn đến với trang quản lý, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Chọn một tùy chọn từ thanh điều hướng để bắt đầu quản lý cửa hàng của bạn.</p>
    </div>

    <body>
        <div id="wrapper-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục sản phẩm</h1>
                        <button type="button" class="btn btn-success" style="margin-bottom: 20px;"
                            onclick="javascript:window.location.href='themsanpham.php'">Thêm sản phẩm mới</button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="12">
                                    <form action="search_subjects.php" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Tìm kiếm sản phẩm...">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-stt">STT</th>
                                <th class="col-equal">Tên sản phẩm</th>
                                <th class="col-equal">Giá</th>
                                <th class="col-equal">Danh mục</th>
                                <th class="desc-col">Mô tả</th>
                                <th class="col-equal">Giảm giá</th>
                                <th class="col-equal">Tình trạng</th>
                                <th class="col-equal">Nổi bật</th>
                                <th class="col-equal">Mới</th>
                                <th class="col-equal">Hình ảnh</th>
                                <th class="col-equal">Ngày thêm</th>
                                <th class="col-equal">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("../database/connect.php");
                                try {
                                    // --- Phân trang ---
                                    $pageSize = 5;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $pageSize;

                                    // --- Đếm tổng số sản phẩm ---
                                    $stmtCount = $conn->query("SELECT COUNT(*) FROM san_pham");
                                    $total = $stmtCount->fetchColumn();

                                    // --- Truy vấn sản phẩm có JOIN danh_muc ---
                                    $sql = "SELECT sp.*, dm.ten_danh_muc 
                                            FROM san_pham sp
                                            LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id
                                            LIMIT :offset, :limit";

                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
                                    $stmt->execute();

                                    $sanPhams = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($sanPhams) {
                                        $i = $offset + 1;
                                        foreach ($sanPhams as $row) {
                                            echo "<tr>";
                                            echo "<td class='col-stt'>{$i}</td>";
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["ten_san_pham"]) . "</td>";
                                            echo "<td class='col-equal'>" . number_format($row["gia"]) . "₫</td>";
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["ten_danh_muc"] ?? 'Không có') . "</td>";
                                            echo "<td class='desc-col'>" . htmlspecialchars($row["mo_ta"] ?? '') . "</td>";
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["giam_phan_tram"] ?? '0') . "%</td>";

                                            // --- Tình trạng ---
                                             // ucfirst(str_replace('_', ' ', ...)) đảm bảo nếu có loại khác (vd: tra_sua) thì sẽ hiển thị thành “Tra sua” tạm thời, tránh bị lỗi rỗng.
                                             //htmlspecialchars() để chống XSS
                                             
                                            switch ($row['tinh_trang']) {
                                                case 'con_hang':
                                                    $tinhTrangClass = 'status-conhang';
                                                    $tinhTrangText = 'Còn hàng';
                                                    break;
                                                case 'het_hang':
                                                    $tinhTrangClass = 'status-hethang';
                                                    $tinhTrangText = 'Hết hàng';
                                                    break;
                                                default:
                                                    $tinhTrangClass = 'status-khac';
                                                    $tinhTrangText = 'Không xác định';
                                                    break;
                                            }

                                            echo "<td class='col-equal'><span class='$tinhTrangClass'>" . htmlspecialchars($tinhTrangText) . "</span></td>";


                                            // --- Nổi bật ---
                                            $noiBatClass = ($row['noi_bat'] == 1) ? 'status-mo' : 'status-dong';
                                            $noiBatText = ($row['noi_bat'] == 1) ? 'Mở' : 'Đóng';
                                            echo "<td class='col-equal'><span class='$noiBatClass'>$noiBatText</span></td>";

                                            // --- Mới ---
                                            $moiClass = ($row['moi'] == 1) ? 'status-mo' : 'status-dong';
                                            $moiText = ($row['moi'] == 1) ? 'Mở' : 'Đóng';
                                            echo "<td class='col-equal'><span class='$moiClass'>$moiText</span></td>";

                                            // --- Hình ảnh ---
                                            //../uploads/ trùng với thư mục mà file thêm/sửa sản phẩm đang lưu hình (move_uploaded_file → ../uploads/).
                                            //file_exists() sẽ tìm đúng vị trí thực tế ảnh nằm trên server.
                                            echo "<td class='col-equal'>";
                                            $imagePath = "../uploads/" . $row['hinh_anh'];

                                            if (!empty($row['hinh_anh']) && file_exists($imagePath)) {
                                                echo "<div class='w-20 h-20 overflow-hidden flex items-center justify-center bg-gray-100'>";
                                                echo "<img src='" . htmlspecialchars($imagePath) . "' 
                                                        alt='" . htmlspecialchars($row['ten_san_pham']) . "' 
                                                        class='object-contain h-full'>";
                                                echo "</div>";
                                            } else {
                                                echo "<div class='w-20 h-20 flex items-center justify-center bg-gray-100 text-gray-400 text-sm'>
                                                        Không có ảnh
                                                    </div>";
                                            }
                                            echo "</td>";

                                            echo "<td class='col-equal'>" . htmlspecialchars($row["ngay_tao"]) . "</td>";

                                            echo "<td class='col-equal'>
                                                <a href='edit_sanpham.php?id=" . htmlspecialchars($row["id"]) . "'
                                                    class='btn btn-warning btn-sm'>Sửa</a>
                                                <a href='del_sanpham.php?id=" . htmlspecialchars($row["id"]) . "'
                                                    class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn
                                                    xóa?');\">Xóa</a>
                                            </td>";
                                            echo "</tr>";
                                            $i++;
                                            }
                                            } else {
                                            echo "<tr>
                                                <td colspan='12'>Không có dữ liệu</td>
                                            </tr>";
                                            }
                                            } catch (PDOException $e) {
                                            echo "Lỗi: " . $e->getMessage();
                                            }
                                            ?>

                            <tr>
                                <td colspan="12" class="pagination">
                                    <?php
                                        // --- Tính tổng số sản phẩm ---
                                        $stmtCount = $conn->query("SELECT COUNT(*) FROM san_pham");
                                        $total = $stmtCount->fetchColumn();

                                        // --- Thiết lập số trang ---
                                        $totalPages = ceil($total / $pageSize);
                                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                        // --- Hiển thị nút phân trang ---
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            $activeClass = ($currentPage === $i) ? 'active' : '';
                                            echo "<a href='list_sanpham.php?page=$i' class='$activeClass'>$i</a>&nbsp;&nbsp;";
                                        }
                                        ?>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>

</html>