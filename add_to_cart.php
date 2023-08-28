<?php
session_start();
require_once('config.php'); // Assure-toi d'inclure la configuration de la base de données

if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Requête SQL pour récupérer les détails du produit
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($connexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Si le panier n'existe pas encore dans la session, le créer
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Vérifie si le produit est déjà dans le panier
        $productIndex = -1;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['product_id'] === $product['id']) {
                $productIndex = $index;
                break;
            }
        }

        if ($productIndex !== -1) {
            // Si le produit existe déjà dans le panier, incrémente la quantité
            $_SESSION['cart'][$productIndex]['quantity']++;
        } else {
            // Sinon, ajoute le produit au panier avec une quantité de 1
            $_SESSION['cart'][] = array(
                'product_id' => $product['id'],
                'product_name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => 1
            );
        }

        // Rediriger l'utilisateur vers la page de la liste des plantes
        header("Location: plantes.php");
        exit();
    } else {
        echo "Produit non trouvé.";
    }
} else {
    echo "Paramètre invalide.";
}
?>
