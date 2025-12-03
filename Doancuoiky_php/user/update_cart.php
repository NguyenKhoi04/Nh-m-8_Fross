<?php
session_start();

$id = $_GET['id'];
$action = $_GET['action'];

if (!isset($_SESSION['cart'][$id])) {
    echo json_encode(['status'=>'error']);
    exit;
}

switch ($action) {
    case "plus":
        $_SESSION['cart'][$id]['quantity']++;
        break;

    case "minus":
        $_SESSION['cart'][$id]['quantity']--;
        if ($_SESSION['cart'][$id]['quantity'] < 1) {
            unset($_SESSION['cart'][$id]);
        }
        break;

    case "remove":
        unset($_SESSION['cart'][$id]);
        break;
}

echo json_encode(['status'=>'success']);
?>