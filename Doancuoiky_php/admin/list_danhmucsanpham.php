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
                            onclick="javascript:window.location.href='themdanhmuc.php'">Thêm danh mục mới</button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="5">
                                    <form action="search_subjects.php" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Tìm kiếm danh  mục...">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-stt">STT</th>
                                <th class="col-equal">Tên danh mục</th>
                                <th class="col-equal">Loại</th>
                                <th class="col-equal">Ngày tạo</th>
                                <th class="col-equal">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../database/connect.php");
                            //dùng PDO thay cho mysqli
                            try {
                                $stmt = $conn->query("SELECT * FROM danh_muc ORDER BY id DESC");
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $count = count($result);
                                $pageSize = 5;
                                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($currentPage - 1) * $pageSize;

                                $stmt = $conn->prepare("SELECT * FROM danh_muc ORDER BY id DESC LIMIT :offset, :pageSize");
                                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
                                $stmt->execute();
                                $pagedResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Kiểm tra nếu có kết quả
                                // ucfirst(str_replace('_', ' ', ...)) đảm bảo nếu có loại khác (vd: tra_sua) thì sẽ hiển thị thành “Tra sua” tạm thời, tránh bị lỗi rỗng.
                                //htmlspecialchars() để chống XSS
                                if (!empty($pagedResult)) {
                                        $stt = $offset + 1;
                                        foreach ($pagedResult as $row) {
                                            // --- Chuyển loại sang tiếng Việt ---
                                            switch ($row['loai']) {
                                                case 'trang_mieng':
                                                    $loaiText = 'Tráng miệng';
                                                    break;
                                                case 'do_uong':
                                                    $loaiText = 'Đồ uống';
                                                    break;
                                                case 'banh_ngot':
                                                    $loaiText = 'Bánh ngọt';
                                                    break;
                                                case 'ca_phe':
                                                    $loaiText = 'Cà phê';
                                                    break;
                                                default:
                                                    $loaiText = ucfirst(str_replace('_', ' ', $row['loai']));
                                                    break;
                                            }

                                            echo '<tr>
                                                    <td>' . $stt++ . '</td>
                                                    <td>' . htmlspecialchars($row['ten_danh_muc']) . '</td>
                                                    <td>' . htmlspecialchars($loaiText) . '</td>
                                                    <td>' . htmlspecialchars($row['ngay_tao']) . '</td>
                                                    <td>
                                                        <a href="edit_danhmuc.php?id=' . urlencode($row['id']) . '" class="btn btn-warning btn-sm">Sửa</a> 
                                                        <a href="del_danhmuc.php?id=' . urlencode($row['id']) . '"
                                                            class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này không?\')">Xóa</a>
                                                    </td>
                                                </tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>Chưa có danh mục nào được thêm.</td></tr>";
                                    }
                                } catch (PDOException $e) {
                                echo "Lỗi truy vấn: " . $e->getMessage();
                            }
                            ?>
                            <tr>
                                <td colspan="5" class="pagination">
                                    <?php
                                        // Nếu chưa có biến page trên URL => mặc định = 1
                                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $totalPages = ceil($count / $pageSize);

                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            $activeClass = ($currentPage === $i) ? 'active' : '';
                                            echo '<a class="' . $activeClass . '" href="list_danhmucsanpham.php?page=' . $i . '">' . $i . '</a> ';
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