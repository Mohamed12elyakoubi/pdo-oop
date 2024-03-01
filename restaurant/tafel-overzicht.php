<?php
include_once('./tafel.php');
$restaurant = new Restaurant();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['tafel']) && !empty($_POST['stoel'])) {
        $restaurant = new Restaurant();
        $tafel = $_POST['tafel'];
        $stoelen = $_POST['stoel'];
        $terras = $_POST['terras'];
        $restaurant->insertrestaurant($tafel, $stoelen, $terras);
        echo '<div class="alert alert-success" role="alert">Tafel is succesvol toegevoegd</div>';
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
                    <th class='table-light'>tafelid</th>
                    <th class='table-light'>tafel</th>
                    <th class='table-light'>aantal stoelen</th>
                    <th class='table-light'>Terrass</th>
                    <th class='table-light' colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $restauranten = $restaurant->selectAll();
                foreach ($restauranten as $restaurant) {
                    echo "<tr>";
                    echo "<td>" . $restaurant['TafelId'] . "</td>";
                    echo "<td>" . $restaurant['tafel'] . "</td>";
                    echo "<td>" . $restaurant['stoelen'] . "</td>";
                    echo "<td>" . $restaurant['terras'] . "</td>";
                    echo "<td><a href='update_tafel.php?TafelId={$restaurant['TafelId']}' class='btn btn-info'>Bewerken</a></td>";
                    echo "<td><a href='delete_tafel.php?TafelId={$restaurant['TafelId']}' class='btn btn-danger'>verwijderen</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="mb-3">Voeg een nieuwe tafels toe</h2>
        <form method="post">
            <div class="mb-3">
                <label for="tafel" class="form-label">Tafel:</label>
                <input type="text" id="tafel" name="tafel" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stoel" class="form-label">Aantal stoelen:</label>
                <input type="number" id="stoel" name="stoel" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="terras" class="form-label">Terras:</label>
                <select class="form-select" name="terras" id="terras">
                    <option value="JA">Ja</option>
                    <option value="Nee">Nee</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Voeg tafel toe</button>
            <br>
            
        </form>
    </div>

</body>

</html>

