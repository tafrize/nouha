<?php
session_start();
require_once('config.php');

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

        // Vérifier si le produit est déjà dans le panier
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Si le produit existe déjà dans le panier, augmenter la quantité
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            // Sinon, ajouter le produit au panier avec une quantité de 1
            $_SESSION['cart'][$product_id] = array(
                'product_name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => 1
            );
        }

        // Rediriger l'utilisateur vers la page du panier
        header("Location: cart.php");
        exit();
    } else {
        echo "Produit non trouvé.";
    }
} else {
    echo "Paramètre invalide.";
}
?>
