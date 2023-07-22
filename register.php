<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    
    <form action="inscription.php" method="POST">
      <h1>Inscription</h1>
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="text" name="adresse" placeholder="Adresse" required>
      <input type="text" name="telephone" placeholder="Téléphone" required>
      <select name="type" required>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
      </select>
      <?php
      session_start();
       if (isset($_SESSION['register_success'])) {
        echo '<div class="error">' . $_SESSION['register_success'] . '</div>';
        unset($_SESSION['register_success']);
      }
      if (isset($_SESSION['register_error'])) {
        echo '<div class="error">' . $_SESSION['register_error'] . '</div>';
        unset($_SESSION['register_error']);
      }
      ?>
      <button type="submit">S'inscrire</button>
      <a href="index.php">Retour à l'authentification</a>
    </form>
  </div>
</body>
</html>
