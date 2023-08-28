
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_number = $_POST["card_number"];
    $expiry_date = $_POST["expiry_date"];
    $cvv = $_POST["cvv"];

    echo "Paiement réussi ! Merci pour votre achat.";
}
?>

