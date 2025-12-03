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
                    <h1 class="page-header">Danh sách tin tức</h1>
                    <button type="button" class="btn btn-success" style="margin-bottom: 20px;"
                        onclick="javascript:window.location.href='themtintucmoi.php'">Thêm tin tức mới</button>
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
                                            placeholder="Tìm kiếm tin tức...">
                                        <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <th class="col-stt">STT</th>
                            <th class="col-equal">Tiêu đề</th>
                            <th class="desc-col">Tóm tắt</th>
                            <th class="desc-col">Nội dung</th>
                            <th class="col-equal">Hình ảnh</th>
                            <th class="col-equal">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include("../database/connect.php");
                        try {
                            $pageSize = 5;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($page - 1) * $pageSize;

                            $stmtCount = $conn->query("SELECT COUNT(*) FROM tin_tuc");
                            $total = $stmtCount->fetchColumn();

                            $sql = "SELECT * FROM tin_tuc ORDER BY id DESC LIMIT :offset, :limit";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
                            $stmt->execute();

                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($data) {
                                $i = $offset + 1;
                                foreach ($data as $row) {

                                    echo "<tr>";
                                    echo "<td class='col-stt'>{$i}</td>";
                                    echo "<td class='col-equal'>" . htmlspecialchars($row["tieu_de"]) . "</td>";

                                    // Tóm tắt (không có ký hiệu ₫)
                                    echo "<td class='desc-col'>" . nl2br(htmlspecialchars($row["tom_tat"])) . "</td>";

                                    // Nội dung HTML (không htmlspecialchars vì là HTML)
                                    echo "<td class='desc-col'>" . $row["noi_dung_html"] . "</td>";

                                    // Hình ảnh
                                    echo "<td class='col-equal'>
                                            <img src='../uploads/" . htmlspecialchars($row["hinh_anh"]) . "'
                                                 alt='" . htmlspecialchars($row["tieu_de"]) . "'
                                                 width='100'>
                                          </td>";

                                    echo "<td class='col-equal'>
                                            <a href='edit_tintuc.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>
                                                Sửa nội dung
                                            </a>
                                            <a href='del_tintuc.php?id=" . $row["id"] . "'
                                               class='btn btn-danger btn-sm'
                                               onclick=\"return confirm('Bạn có chắc muốn xóa tin này?');\">
                                                Xóa tin tức
                                            </a>
                                          </td>";
                                    echo "</tr>";

                                    $i++;
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
                                $totalPages = ceil($total / $pageSize);
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $active = ($i == $page) ? "style='font-weight:bold;'" : "";
                                    echo "<a href='list_tintuc.php?page=$i' $active>$i</a> ";
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