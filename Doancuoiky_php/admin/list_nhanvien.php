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
                        <h1 class="page-header">Danh sách nhân viên</h1>
                        <button type="button" class="btn btn-success" style="margin-bottom: 20px;"
                            onclick="javascript:window.location.href='themnhanvien.php'">Thêm nhân viên</button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="6">
                                    <form action="search_subjects.php" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Tìm kiếm nhân viên">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-stt">STT</th>
                                <th class="col-equal">Tên người dùng</th>
                                <th class="col-equal">Họ và tên</th>
                                <th class="col-equal">Email</th>
                                <th class="col-equal">Số điện thoại</th>
                                <th class="col-equal">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("../database/connect.php"); // file này nên trả về $conn là PDO object
                                try {
                                    // Cấu hình phân trang
                                    $pageSize = 5;
                                    $currentPage = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                                    $offset = ($currentPage - 1) * $pageSize;

                                    // Đếm tổng số nhân viên
                                    $countSql = "SELECT COUNT(*) FROM nguoi_dung WHERE vai_tro = 2";
                                    $stmtCount = $conn->prepare($countSql);
                                    $stmtCount->execute();
                                    $totalRecords = $stmtCount->fetchColumn();
                                    $totalPages = ceil($totalRecords / $pageSize);

                                    // Lấy danh sách nhân viên có giới hạn
                                    $sql = "SELECT * FROM nguoi_dung WHERE vai_tro = 2 LIMIT :offset, :limit";
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
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["ho_ten"]) . "</td>";
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["email"]) . "</td>";
                                            echo "<td class='col-equal'>" . htmlspecialchars($row["so_dien_thoai"]) . "</td>";
                                            echo "<td class='col-equal'>
                                                    <a href='edit_nhanvien.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning btn-sm'>Sửa</a>
                                                    <a href='del_nhanvien.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
                                    }

                                } catch (PDOException $e) {
                                    echo "Lỗi: " . $e->getMessage();
                                }
                                ?>

                            <tr>
                                <td colspan="6" class="pagination">
                                    <?php
                                        // --- Tính tổng số nhân viên ---
                                        $stmtCount = $conn->query("SELECT COUNT(*) FROM nguoi_dung WHERE vai_tro = 2");
                                        $total = $stmtCount->fetchColumn();

                                        // --- Thiết lập số trang ---
                                        $totalPages = ceil($total / $pageSize);
                                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                        // --- Hiển thị nút phân trang ---
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

    </body>

</html>