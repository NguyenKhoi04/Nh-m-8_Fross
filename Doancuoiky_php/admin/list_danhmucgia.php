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
                        <h1 class="page-header">Danh mục sách</h1>
                        <button type="button" class="btn btn-success" style="margin-bottom: 20px;"
                            onclick="javascript:window.location.href='insert_book.php'">Thêm sách mới</button>
                    </div>
                </div>
                <div class="table-responsive table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="5">
                                    <form action="search_subjects.php" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Tìm kiếm sách">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-stt">STT</th>
                                <th class="col-equal">Tên sách</th>
                                <th class="col-equal">Giá</th>
                                <th class="col-equal">Chủ đề</th>
                                <th class="col-equal">Hình ảnh</th>
                                <th class="col-equal">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../database/connect.php");
                                // --- Truy vấn có JOIN ---
                                $sql = "SELECT b.*, s.name_subject 
                                        FROM tblbooks b
                                        LEFT JOIN tblsubject s ON b.id_subject = s.id_subject";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);

                                $pageSize = 5;
                               $pos = (!isset($_GET["page"])) ? 0 : (($_GET["page"] - 1) * $pageSize);
                                $sql .= " LIMIT $pos, $pageSize";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $i = $pos + 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td class='col-stt'>" . ($i++) . "</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["name_book"]) . "</td>";
                                        echo "<td class='col-equal'>" . number_format($row["price"]) . "₫</td>";
                                        echo "<td class='col-equal'>" . htmlspecialchars($row["name_subject"] ?? 'Không có') . "</td>";
                                        echo "<td class='col-equal'><img src='../uploads/" . htmlspecialchars($row["images"]) . "' alt='" . htmlspecialchars($row["name_book"]) . "' width='100'></td>";
                                        echo "<td class='col-equal'>
                                                <a href='edit_book.php?id=" . htmlspecialchars($row["id_book"]) . "' class='btn btn-warning btn-sm'>Sửa</a>
                                                <a href='del_book.php?id=" . htmlspecialchars($row["id_book"]) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
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
                                            echo "<a href='list_books.php?page=$i' class='$activeClass'>$i</a>&nbsp;&nbsp;";
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