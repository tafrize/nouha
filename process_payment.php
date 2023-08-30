<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = mysqli_query($connexion, $sql);
        $product = mysqli_fetch_assoc($result);
        $totalPrice += ($product['price'] * $item['quantity']);
    }

    $insertOrderQuery = "INSERT INTO orders (user_name, user_email, total_price) VALUES ('$name', '$email', '$totalPrice')";
    mysqli_query($connexion, $insertOrderQuery);

    $order_id = mysqli_insert_id($connexion);


    foreach ($_SESSION['cart'] as $product_id => $item) {
        $quantity = $item['quantity'];
        $insertDetailQuery = "INSERT INTO order_details (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
        mysqli_query($connexion, $insertDetailQuery);
    }

    unset($_SESSION['cart']);

    echo "<script>";
    echo "alert('Commande passée avec succès !');";
    echo "window.location.href = 'cart.php';";
    echo "</script>";
}
?>
