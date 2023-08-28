<?php
require_once('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les valeurs du formulaire
  $nom = $_POST['nom'];
  $adresse = $_POST['adresse'];
  $telephone = $_POST['telephone'];
  $email = $_POST['email'];
  $prenom = $_POST['prenom'];
  $password = $_POST['password'];
  $type = $_POST['type'];

  // Insérer les données dans la base de données
  // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

  // Requête préparée pour insérer les données
  $stmt = $connexion->prepare("INSERT INTO client (nom, adresse, telephone, email, prenom, password, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $nom, $adresse, $telephone, $email, $prenom, $password, $type);

  // Exécuter la requête
  if ($stmt->execute()) {
    session_start();
    $_SESSION['register_success'] = "Inscription réussie.";
    header('location: register.php');
    exit();
  } else {
    session_start();
    $_SESSION['register_error'] = "L'inscription a échouée.";
    header('location: register.php');
    exit();
  }

  // Fermer la connexion à la base de données
  $stmt->close();
  $pdo->close();
}
?>


