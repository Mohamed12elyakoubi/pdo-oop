<?php
include_once('./tafel.php');

if (isset($_GET['TafelId'])) {
    $tafelId = $_GET['TafelId'];
    $restaurant = new Restaurant();
    $restaurant->deleteTafel($tafelId);
    header("Location: tafel-overzicht.php");
    exit();

} else {
    echo "Geen tafel ID opgegeven.";
}
?>