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

    <div id="wrapper-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách đánh giá sản phẩm từ khách hàng</h1>
                </div>
            </div>
            <div class="table-responsive table-bordered">
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <form action="search_subjects.php" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Tìm kiếm khách hàng đánh giá sản phẩm..">
                                        <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-stt">STT</th>
                            <th class="col-equal">Tên người dùng</th>
                            <th class="col-equal">Sản phẩm</th>
                            <th class="col-equal">Số sao</th>
                            <th class="col-equal">Nội dung</th>
                            <th class="col-equal">Ngày đánh giá</th>
                            <th class="col-equal">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("../database/connect.php"); // kết nối PDO

                            try {
                                // Cấu hình phân trang
                                $pageSize = 5;
                                $currentPage = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                                $offset = ($currentPage - 1) * $pageSize;

                                // --- Đếm tổng số đánh giá ---
                                $countSql = "SELECT COUNT(*) 
                                            FROM danh_gia dg
                                            JOIN nguoi_dung nd ON dg.id_nguoi_dung = nd.id
                                            JOIN san_pham sp ON dg.id_san_pham = sp.id";
                                $stmtCount = $conn->prepare($countSql);
                                $stmtCount->execute();
                                $totalRecords = $stmtCount->fetchColumn();
                                $totalPages = ceil($totalRecords / $pageSize);

                                // --- Lấy danh sách đánh giá (JOIN 3 bảng) ---
                                $sql = "SELECT dg.id, nd.ten_dang_nhap, sp.ten_san_pham, dg.so_sao, dg.noi_dung, dg.ngay_tao
                                        FROM danh_gia dg
                                        JOIN nguoi_dung nd ON dg.id_nguoi_dung = nd.id
                                        JOIN san_pham sp ON dg.id_san_pham = sp.id
                                        ORDER BY dg.ngay_tao DESC
                                        LIMIT :offset, :limit";

                                $stmt = $conn->prepare($sql);
                                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
                                $stmt->execute();

                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if ($results) {
                                    $i = $offset + 1;
                                    foreach ($results as $row) {
                                        echo "<tr>";
                                        echo "<td class='col-stt'>" . ($i++) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["ten_dang_nhap"]) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["ten_san_pham"]) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["so_sao"]) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["noi_dung"]) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["ngay_tao"]) . "</td>";
                                        echo "<td class='col-equal'>
                                                <a href='edit_danhgia.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning btn-sm'>Sửa</a>
                                                <a href='del_danhgia.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
                                }

                            } catch (PDOException $e) {
                                echo "Lỗi: " . $e->getMessage();
                            }
                            ?>


                        <tr>
                            <td colspan="7" class="pagination">
                                <?php
                                    $stmtCount = $conn->query("SELECT COUNT(*) 
                                                            FROM danh_gia dg
                                                            JOIN nguoi_dung nd ON dg.id_nguoi_dung = nd.id
                                                            JOIN san_pham sp ON dg.id_san_pham = sp.id");
                                    $total = $stmtCount->fetchColumn();
                                    $totalPages = ceil($total / $pageSize);
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        $activeClass = ($i === $currentPage) ? "style='font-weight:bold;color:blue;'" : "";
                                        echo "<a href='?page=$i' $activeClass> $i </a> ";
                                    }
                                ?>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
</body>

</html>