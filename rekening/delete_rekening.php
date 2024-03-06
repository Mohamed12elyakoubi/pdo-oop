<?php
include_once('rekening.php');

if (isset($_GET['bestelling_id'])) {
    $bestelling_id = $_GET['bestelling_id'];
    $bestelling = new Rekening();
    $bestelling->deletebestelling($bestelling_id);
    header("Location: bestelling-overzicht.php");
    exit();

} else {
    echo "Geen bestelling ID opgegeven.";
}
?>
