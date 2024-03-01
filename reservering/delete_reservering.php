<?php
include_once('./reservering.php');

if (isset($_GET['ReserveringID'])) {
    $ReserveringID = $_GET['ReserveringID'];
    $reservering = new Reservering();
    $reservering->deletereservering($ReserveringID);
    header("Location: reservering-overzicht.php");
    exit();

} else {
    echo "Geen ReserveringID opgegeven.";
}
?>