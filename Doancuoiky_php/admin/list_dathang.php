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

    <main id="wrapper-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Quản lý đơn hàng</h1>
                    <button type="button" class="btn btn-success" style="margin-bottom: 20px;"
                        onclick="window.location.href='themdonhang.php'">Thêm đơn hàng</button>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="12">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Tìm kiếm theo tên khách hoặc username..."
                                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                        <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách</th>
                            <th>Địa chỉ</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Giảm giá</th>
                            <th>Thành tiền</th>
                            <th>Ghi chú từng sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú giao hàng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../database/connect.php"); // $conn = PDO object

                        try {
                            // --- Tìm kiếm ---
                            $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                            // --- Phân trang ---
                            $pageSize = 5;
                            $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
                            $offset = ($currentPage - 1) * $pageSize;

                            // --- Truy vấn chính: JOIN 4 bảng ---
                            $sql = "
                                SELECT dh.id AS id_don_hang, nd.ho_ten, nd.ten_dang_nhap, dh.dia_chi_giao, dh.trang_thai, dh.ghi_chu_giao_hang,
                                       sp.ten_san_pham, ctdh.so_luong, ctdh.don_gia, ctdh.giam_phan_tram, ctdh.thanh_tien, ctdh.ghi_chu
                                FROM don_hang dh
                                JOIN nguoi_dung nd ON dh.id_nguoi_dung = nd.id
                                JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
                                JOIN san_pham sp ON ctdh.id_san_pham = sp.id
                                WHERE (:search = '' OR nd.ho_ten LIKE :search_like OR nd.ten_dang_nhap LIKE :search_like)
                                ORDER BY dh.id DESC
                                LIMIT :offset, :limit
                            ";

                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(':search', $search, PDO::PARAM_STR);
                            $stmt->bindValue(':search_like', "%$search%", PDO::PARAM_STR);
                            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // --- Đếm tổng số bản ghi ---
                            $countSql = "
                                SELECT COUNT(*)
                                FROM don_hang dh
                                JOIN nguoi_dung nd ON dh.id_nguoi_dung = nd.id
                                WHERE (:search = '' OR nd.ho_ten LIKE :search_like OR nd.ten_dang_nhap LIKE :search_like)
                            ";
                            $stmtCount = $conn->prepare($countSql);
                            $stmtCount->bindValue(':search', $search, PDO::PARAM_STR);
                            $stmtCount->bindValue(':search_like', "%$search%", PDO::PARAM_STR);
                            $stmtCount->execute();
                            $totalRecords = (int)$stmtCount->fetchColumn();
                            $totalPages = $totalRecords > 0 ? ceil($totalRecords / $pageSize) : 1;

                            // --- Hiển thị dữ liệu ---
                            if ($rows) {
                                $i = $offset + 1;
                                foreach ($rows as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";

                                    // Tên khách
                                    $tenKhach = $row['ho_ten'] ?: $row['ten_dang_nhap'];
                                    echo "<td>" . htmlspecialchars($tenKhach) . "</td>";

                                    echo "<td>" . htmlspecialchars($row['dia_chi_giao'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ten_san_pham'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['so_luong'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars(number_format($row['don_gia'], 0, ',', '.')) . " đ</td>";
                                    echo "<td>" . htmlspecialchars(number_format($row['giam_phan_tram'], 0, ',', '.')) . " %</td>";
                                    echo "<td>" . htmlspecialchars(number_format($row['thanh_tien'], 0, ',', '.')) . " đ</td>";
                                    echo "<td>" . htmlspecialchars($row['ghi_chu'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['trang_thai'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ghi_chu_giao_hang'] ?? '') . "</td>";
                                    echo "<td>
                                            <a href='edit_donhang.php?id=" . htmlspecialchars($row['id_don_hang']) . "' class='btn btn-warning btn-sm'>Sửa</a>
                                            <a href='delete_donhang.php?id=" . htmlspecialchars($row['id_don_hang']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa đơn hàng này?');\">Xóa</a>
                                          </td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='12'>Không có dữ liệu</td></tr>";
                            }

                        } catch (PDOException $e) {
                            echo "<tr><td colspan='12'>Lỗi: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                        ?>

                        <!-- Phân trang -->
                        <tr>
                            <td colspan="12" class="pagination">
                                <?php
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $activeClass = ($currentPage == $i) ? "active" : "";
                                    echo "<a href='?page=$i' class='$activeClass'>$i</a> ";
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>