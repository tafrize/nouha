<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Paiement</title>
    <link rel="stylesheet" href="paiement.css">
</head>
<body>
    <div class="container">
    <div class="section">
        <h1>Formulaire de Paiement</h1>
        <form action="paiement.php" method="post">
            <label for="card_number">Numéro de Carte:</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            
            <label for="expiry_date">Date d'expiration:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA" required>
            
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>
            
            <button type="submit">Payer</button>
        </form>
    </div>
    <div class="section">
        <h1>Formulaire de Paiement</h1>
        <form action="paiement.php" method="post">
            <label for="card_number">Numéro de Carte:</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            
            <label for="expiry_date">Date d'expiration:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA" required>
            
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>
            
            <button type="submit">Payer</button>
        </form>
    </div>
</div>
</body>
</html>