<?php
session_start();
require_once('config.php');

if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $action = $_GET['action'];
    $product_id = $_GET['product_id'];

    if ($action === 'increase') {
        increaseQuantity($product_id);
    } elseif ($action === 'decrease') {
        decreaseQuantity($product_id);
    }
}

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
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cart.css">
        <title>Panier</title>
    </head>
    <body>
        <div class="cart-container">
            <div class="cart-items">
                <?php
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    $totalPrice = 0;

                    foreach ($_SESSION['cart'] as $product_id => $item) {
                        $sql = "SELECT * FROM products WHERE id = $product_id";
                        $result = mysqli_query($connexion, $sql);

                        if ($product = mysqli_fetch_assoc($result)) {
                            echo "<div class='cart-item'>";
                            echo "<div class='item-image'><img src='{$product['image_url']}' alt='{$product['product_name']}'></div>";
                            echo "<div class='item-details'>";
                            echo "<h3>{$product['product_name']}</h3>";
                            echo "<p>Prix unitaire: {$product['price']} €</p>";
                            echo "<p class='item-quantity'>Quantité: ";
                            echo "<a href='cart.php?action=decrease&product_id=$product_id'>-</a>";
                            echo "<span>{$item['quantity']}</span>";
                            echo "<a href='cart.php?action=increase&product_id=$product_id'>+</a>";
                            echo "</p>";
                            echo "<p>Total: " . ($product['price'] * $item['quantity']) . " €</p>";
                            echo "</div>";
                            echo "</div>";
                            $totalPrice += ($product['price'] * $item['quantity']);
                        }
                    }
                    echo "<p class='total-price'>Total général: $totalPrice €</p>";
                } else {
                    echo "<h1>Mon Panier est Vide</h1>";
                }
                ?>
                </php>
            </div>
            <div class="cart-form">
                <form action="process_payment.php" method="post" >
                    <h2>Informations de Paiement</h2>
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required><br>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="card_number">Numéro de Carte:</label>
                    <input type="text" id="card_number" name="card_number" required><br>
                    <label for="card_expiry">Date d'expiration:</label>
                    <input type="text" id="card_expiry" name="card_expiry" required><br>
                    <!-- Ajoutez d'autres champs de la carte bancaire ici si nécessaire -->

                    <button type="submit">Payer</button>
                </form>
            </div>
        </div>
    </body>
</html>

