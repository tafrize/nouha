<!DOCTYPE html>
<html>
<head>
  <title>Authentification</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
   
  
    <form action="connexion.php" method="POST">
      <h1>Authentification</h1>  
      <label><b>Adresse mail</b></label>
      <input type="text" name="email" placeholder="Email" required>
      <label><b>Mot de passe</b></label>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <?php
      // Afficher un message d'erreur en cas d'erreur de connexion
      session_start();
      if (isset($_SESSION['login_error'])) {
        echo '<div class="error">' . $_SESSION['login_error'] . '</div>';
        unset($_SESSION['login_error']);
      }
      ?>
      <button type="submit">Se connecter</button> 
      <a href="register.php">S'inscrire</a>
      <a href="register.php">Mot de passe oublié</a>
    </form>
    
  </div>
</body>
</html>
