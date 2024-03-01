<?php
include_once('./klant.php');
$klant = new Klant();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['klantnaam']) && !empty($_POST['email']) && !empty($_POST['telefoonnummer'])) {
        $klantnaam = $_POST['klantnaam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $klant->insertKlant($klantnaam, $email, $telefoonnummer);
        echo '<div class="alert alert-success" role="alert">Klant is succesvol toegevoegd</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../navbar.js" defer></script>
</head>

<body>
    <nav id="navbar"></nav>

    <div class="container">
        <h1 class="mt-5 mb-4">Overzicht</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class='table-light'>KlantID</th>
                    <th class='table-light'>Klantnaam</th>
                    <th class='table-light'>Klant emailadres</th>
                    <th class='table-light'>Klant telefoonnr.</th>
                    <th class='table-light' colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $klanten = $klant->selectAll();
                foreach ($klanten as $klant) {
                    echo "<tr>";
                    echo "<td>" . $klant['klantId'] . "</td>";
                    echo "<td>" . $klant['klantnaam'] . "</td>";
                    echo "<td>" . $klant['email'] . "</td>";
                    echo "<td>" . "0" . $klant['telefoonnummer'] . "</td>";
                    echo "<td><a href='update_klant.php?klantId={$klant['klantId']}' class='btn btn-info'>Bewerken</a></td>";
                    echo "<td><a href='delete_klant.php?klantId={$klant['klantId']}' class='btn btn-danger'>verwijderen</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <h2 class="mb-3">Voeg een nieuwe klant toe</h2>
        <form method="post">
            <div class="mb-3">
                <label for="klantnaam" class="form-label">klantnaam:</label>
                <input type="text" id="klantnaam" name="klantnaam" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefoonnummer" class="form-label">telefoonnummer:</label>
                <input  type="text" id="telefoonnummer" name="telefoonnummer" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Voeg Product toe</button>
            <br>
            
        </form>
    </div>
</body>

</html>