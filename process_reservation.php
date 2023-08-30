<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$date = $_POST['date'];
$heure = $_POST['heure']; // Nouveau champ d'heure
$personnes = $_POST['personnes'];

// Combinaison de la date et de l'heure
$dateComplete = $date . ' ' . $heure;

// Enregistrement dans la base de données
$sql = "INSERT INTO reservations (nom, email, date_heure, personnes) VALUES ('$nom', '$email', '$dateComplete', '$personnes')";
if ($connexion->query($sql) === TRUE) {
    echo "Réservation enregistrée avec succès.";
} else {
    echo "Erreur : " . $sql . "<br>" . $connexion->error;
}

$connexion->close();

}
?>
