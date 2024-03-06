<?php
include_once('./reservering.php');
include_once('../klant/klant.php');
include_once('../restaurant/tafel.php');

$reservering = new Reservering();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Tafel']) && !empty($_POST['klantId']) && !empty($_POST['start-reservering']) && !empty($_POST['einde-reservering'])) {
        $Tafel = $_POST['Tafel'];
        $klantId = $_POST['klantId'];
        $startreservering = $_POST['start-reservering'];
        $eindereservering = $_POST['einde-reservering'];
        $reservering->insertreservering($Tafel, $klantId, $startreservering, $eindereservering);
        echo '<div class="alert alert-success" role="alert">Reservering is succesvol toegevoegd</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restaurant toevoegen</title>
    <script src="../navbar.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav id="navbar"></nav>

    <div class="container">
        <h1 class="mt-5 mb-4">Overzicht</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class='table-light'>ReserveringID</th>
                    <th class='table-light'>Tafel</th>
                    <th class='table-light'>Klant</th>
                    <th class='table-light'>Start Reservering</th>
                    <th class='table-light'>Einde Reservering</th>
                    <th class='table-light' colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $reservering = new Reservering();
                    $reserveringen = $reservering->selectAll();

                foreach ($reserveringen as $res) {
        echo "<tr>";
        echo "<td>" . $res['ReserveringID'] . "</td>";


        $restaurant = new Restaurant();
        $tafelinfo = $restaurant->selectAll();
        foreach ($tafelinfo as $tafel) {
            if ($tafel['TafelId'] == $res['Tafel']) {
                $tafelnaam = $tafel['tafel'];
                break;
            }
        }
        echo "<td>" . $res['Tafel'] ." - " . $tafelnaam . "</td>";


        $klant = new Klant();
        $klantinfo = $klant->selectAll();
        foreach ($klantinfo as $kl) {
            if ($kl['klantId'] == $res['klantId']) {
                $klantnaam = $kl['klantnaam'];
                break;
            }
        }
        echo "<td>" . $klantnaam . "</td>";

        echo "<td>" . $res['start-reservering'] . "</td>";
        echo "<td>" . $res['einde-reservering'] . "</td>";
        echo "<td><a href='update_reservering.php?ReserveringID={$res['ReserveringID']}' class='btn btn-info'>Bewerken</a></td>";
        echo "<td><a href='delete_reservering.php?ReserveringID={$res['ReserveringID']}' class='btn btn-danger'>verwijderen</a></td>";
        echo "</tr>";
    }
                ?>
            </tbody>
        </table>

        <h2 class="mb-3">Voeg een nieuwe Reservering toe</h2>
        <form method="post">

            <div class="mb-3">
                <label for="Tafel" class="form-label">Tafel:</label>
                <select class="form-select" name="Tafel" id="Tafel">
                    <?php
                            $restaurant = new Restaurant();

                    $tafels = $restaurant->selectAll();
                    foreach ($tafels as $tafel) {
                        echo "<option value='" . $tafel['TafelId'] . "'>" . $tafel['tafel'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="klantId" class="form-label">klantId:</label>
                <select class="form-select" name="klantId" id="klantId">
                <option value="" disabled selected>select een klant</option>
            <?php
            $klant = new Klant();
            $klanten = $klant->selectAll();
            foreach ($klanten as $klant) {
                echo "<option value='" . $klant['klantId'] . "'>" . $klant['klantnaam'] . " - " . $klant['email'] . " - 0" . $klant['telefoonnummer'] . "</option>";
            }
            ?>
                </select>
            </div>
            <div class="mb-3">
            <label for="start-reservering">Start reservering:</label><br>
            <input type="datetime-local" id="start-reservering" name="start-reservering" class="form-control" required>
            </div>

            <div class="mb-3">
            <label for="einde-reservering">Einde reservering:</label><br>
            <input type="datetime-local" id="einde-reservering" name="einde-reservering" class="form-control" required>

            </div>
            <button type="submit" class="btn btn-primary">Voeg reservering toe</button>
            <br>

        </form>
    </div>

</body>

</html>