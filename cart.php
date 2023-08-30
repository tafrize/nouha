<?php

require_once('config.php'); // Inclure la configuration de la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_cart.css"> <!-- Lien vers ton fichier CSS -->
    <title>Panier</title>
</head>
<body>
    <?php
    session_start();
    require_once('config.php');

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<h1>Mon Panier</h1>";

        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $product_id => $item) {
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = mysqli_query($connexion, $sql);

            if ($product = mysqli_fetch_assoc($result)) {
                echo "<div class='cart-item'>";
                echo "<img src='{$product['image_url']}' alt='{$product['product_name']}' styles={ ... }>";
                echo "<h3>{$product['product_name']}</h3>";
                echo "<p>Prix unitaire: {$product['price']} €</p>";
                echo "<p>Quantité: ";
                echo "<button class='quantity-action' data-product-id='$product_id' data-action='decrease'>-</button>";
                echo "<span class='item-quantity'>{$item['quantity']}</span>";
                echo "<button class='quantity-action' data-product-id='$product_id' data-action='increase'>+</button>";
                echo "</p>";
                echo "<p>Total: <span class='item-total'>" . ($product['price'] * $item['quantity']) . " €</span></p>";
                echo "</div>";

                $totalPrice += ($product['price'] * $item['quantity']);
            }
        }

        echo "<p>Total général: <span id='total-price'>$totalPrice €</span></p>";
    } else {
        echo "<h1>Mon Panier est Vide</h1>";
    }
    ?>

    <script src="cart.js"></script>
</body>
</html>