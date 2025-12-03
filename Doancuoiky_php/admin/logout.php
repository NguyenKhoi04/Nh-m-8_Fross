<?php
session_start();
// Hủy tất cả session
session_unset();
session_destroy();
// Chuyển về đăng nhập
header("Location:admin_dn.php");
exit();
?>