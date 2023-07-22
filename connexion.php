<?php
require_once('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les valeurs du formulaire
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Vérifier les identifiants dans la base de données
  // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

  // Requête préparée pour récupérer les informations du client en fonction de l'email
  $req = $connexion->prepare("SELECT * FROM client WHERE email=? AND password=?");
  $req->bind_param("ss", $email, $password);
  $req->execute();
  $result = $req->get_result();

  // Récupérer le nombre de lignes affectées
  if ($result->num_rows==1) {
    // Récupérer les données du client
    $row = $result->fetch_assoc();
    
    // Les identifiants sont valides
    session_start();
    $_SESSION['email'] = $email;
    if ($_SESSION['email'] && $row['type'] == 'Admin') {
      header('location: home.php');      
    } else {
      header('location: home.php');
    }
    exit(); // Ajoutez cette ligne pour terminer le script après la redirection
  } else {
    session_start();
    $_SESSION['login_error'] = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    header('location: index.php');
    exit();
  }
}
?>
