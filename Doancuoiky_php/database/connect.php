<?php
$host = 'localhost';
$dbname = 'cafe_bakery';
$username = 'root';
$password = 'Khoi230405'; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Kết nối thành công đến cơ sở dữ liệu cafe_bakery!";
} catch(PDOException $e) {
    echo "❌ Lỗi kết nối: " . $e->getMessage();
}
?>