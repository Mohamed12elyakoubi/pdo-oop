<?php
include_once('../../week4/classes.php');


$restaurant = new Restaurant();
$reservering = new Reservering();
$rekening = new Rekening();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['datum']) && !empty($_POST['tijd']) && !empty($_POST['tafel_id']) && !empty($_POST['afdeling'])&& !empty($_POST['aantal'])&&
     !empty($_POST['omschrijving']) && !empty($_POST['prijs'])&& !empty($_POST['Totaal']) && !empty($_POST['BTW']) && !empty($_POST['incBTW']) && !empty($_POST['ExclBTW'])) {
        $datum = $_POST['datum'];
        $tijd = $_POST['tijd'];
        $tafel_id = $_POST['tafel_id'];
        $afdeling = $_POST['afdeling'];
        $aantal = $_POST['aantal'];
        $omschrijving = $_POST['omschrijving'];
        $prijs = $_POST['prijs'];
        $Totaal = $_POST['Totaal'];
        $BTW = $_POST['BTW'];
        $incBTW = $_POST['incBTW'];
        $ExclBTW = $_POST['ExclBTW'];
        $rekening->insertrekening($datum, $tijd, $tafel_id, $afdeling, $aantal, $omschrijving, $prijs, $Totaal, $BTW, $incBTW, $ExclBTW);
        echo "rekening is succesvol toegevoegd!";
    } else {
        echo "Alle velden zijn verplicht!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg een nieuwe Reservering toe</title>
</head>

<body>
    <h2>Voeg een nieuwe Reservering toe</h2>
    <form method="post">
        <label for="Tafel">Tafel:</label><br>
        <select name="Tafel" id="Tafel">
            <?php
            $tafels = $restaurant->selectAll();
            foreach ($tafels as $tafel) {
                echo "<option value='" . $tafel['TafelId'] . "'>" . $tafel['tafel'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="klantId">Klant ID:</label><br>
        <select name="klantId" id="klantId">
        <option value="" disabled selected>select een klant</option>
            <?php
            $klanten = $klant->selectAll();
            foreach ($klanten as $klant) {
                echo "<option value='" . $klant['klantId'] . "'>" . $klant['klantnaam'] . " - " . $klant['email'] . " - 0" . $klant['telefoonnummer'] . "</option>";
            }
            ?>

        </select><br><br>

        <label for="start-reservering">Start reservering:</label><br>
        <input type="datetime-local" id="start-reservering" name="start-reservering" required><br><br>

        <label for="einde-reservering">Einde reservering:</label><br>
        <input type="datetime-local" id="einde-reservering" name="einde-reservering" required><br><br>

        <input type="submit" value="Voeg Reservering toe">
    </form>
</body>

</html>