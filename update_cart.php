<?php
session_start();

if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $action = $_GET['action'];
    $product_id = $_GET['product_id'];
    if ($action === 'increase') {
        increaseQuantity($product_id);
    } elseif ($action === 'decrease') {
        decreaseQuantity($product_id);
    }
}

header('Location: cart.php');

function increaseQuantity($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    }
}

function decreaseQuantity($product_id) {
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] > 1) {
        $_SESSION['cart'][$product_id]['quantity']--;
    } elseif (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}
?>
