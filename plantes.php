<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles_plantes.css">
        <title>Liste des Plantes</title>
    </head>
    <body>
        <h1>Liste des Plantes</h1>
        <p>Laissez vous emporter par la nature et ses merveilles</p>
        <div class="product-list"> 
                
        <?php
        require_once('config.php');

        $sql = "SELECT * FROM products";
        $result = mysqli_query($connexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['product_name']; ?>">
                    <h3><?php echo $row['product_name']; ?></h3>
                    <p class="price"><?php echo $row['price']; ?> €</p>
                    <p><?php echo $row['description']; ?></p>
                    <a href="add_to_cart.php?product_id=<?php echo $row['id']; ?>" class="add-to-cart">Ajouter au Panier</a>
                </div>
        <?php
            }
        } else {
            echo "Aucun produit trouvé.";
        }
        ?>
        </div>
    </body>
</html>        

