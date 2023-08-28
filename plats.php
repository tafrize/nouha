<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_plats.css">
    <title>Liste des plats</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="plats.php">Tous les plats</a></li>
            <li><a href="plats.php?category=entrees">Entrées</a></li>
            <li><a href="plats.php?category=plats_principaux">Plats Principaux</a></li>
            <li><a href="plats.php?category=desserts">Desserts</a></li>
        </ul>
    </nav>
    
    <div class="menu">
        <?php
        require_once('config.php');

        $category = isset($_GET['category']) ? $_GET['category'] : '';

        $sql = "SELECT * FROM plats";
        if (!empty($category)) {
            $sql .= " WHERE categorie = '$category'";
        }
        
        $result = $connexion->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="plat">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['nom'] . '">';
                echo '<h2>' . $row['nom'] . '</h2>';
                echo '<p class="description">' . $row['description'] . '</p>';
                echo '<p class="prix">' . $row['prix'] . ' €</p>';   
                echo '</div>';
            }
        } else {
            echo 'Aucun plat trouvé.';
        }

        $connexion->close();
        ?>
    </div>
</body>
</html>
