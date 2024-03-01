<?php
include_once('./klant.php');

if (isset($_GET['klantId'])) {
    $klantId = $_GET['klantId'];
    $klant = new Klant();
    $klant->deleteklant($klantId);
    header("Location: klant-overzicht.php");
    exit();
    echo '<div class="alert alert-success" role="alert">Klant is succesvol verwijderd</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Geen Id opgegeven</div>';
}
?>