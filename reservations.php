<?php
require_once('config.php');

$reservationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $personnes = $_POST['personnes'];

    $dateComplete = $date . ' ' . $heure;

    // Enregistrement dans la base de données
    $sql = "INSERT INTO reservations (nom, email, date_heure, personnes) VALUES ('$nom', '$email', '$dateComplete', '$personnes')";
    if ($connexion->query($sql) === TRUE) {
        $reservationSuccess = true;
    } else {
        $reservationSuccess = false;
    }
}

$connexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réservation de table</title>
    <link rel="stylesheet" type="text/css" href="reservations.css"> <!-- Assurez-vous d'ajuster le chemin vers votre fichier CSS -->
</head>
<body>
    <div class="page-container">
        <div class="left-section">
            <div class="image-carousel">
                <!-- Ajoutez ici votre code pour le carousel d'images -->
                <img src="https://www.toureiffel.paris/sites/default/files/styles/1200x675/public/actualite/image_principale/restaurant_banner_main.jpg?itok=Yoj-sKHl" alt="Image 1">
            </div>
        </div>
        <div class="right-section">
            <div class="reservation-form">
                <h2>Réserver une table</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if ($reservationSuccess) {
                        echo '<div class="alert success">Réservation réussie !</div>';
                    } else {
                        echo '<div class="alert error">Erreur lors de la réservation.</div>';
                    }
                }
                ?>
                <form action="" method="POST">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" placeholder="Un nom pour la réservation" required>
                    
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Un email" required>
                    
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" required>

                    <label for="heure">Heure :</label>
                    <input type="time" id="heure" name="heure" required>

                    <label for="personnes">Nombre de personnes :</label>
                    <input type="number" id="personnes" name="personnes" placeholder="Pour combien de personne ?" required>
                    
                    <input type="submit" value="Réserver">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
