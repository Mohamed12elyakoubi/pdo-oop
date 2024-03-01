<?php
include_once('./klant.php');

$klant = new Klant();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['klantnaam']) && !empty($_POST['email']) && !empty($_POST['telefoonnummer'])) {
        $klantnaam = $_POST['klantnaam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $klantId = $_POST['klantId'];
        
        $klant->updateKlant($klantId, $klantnaam, $email, $telefoonnummer);
        echo '<div class="alert alert-success" role="alert">Klantgegevens zijn succesvol bijgewerkt</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}

if(isset($_GET['klantId'])) {
    $klantId = $_GET['klantId'];
    $klantData = $klant->getKlantById($klantId);
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant bijwerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Klant bijwerken</h1>
        <?php if (!empty($klantData)) : ?>
        <form method="post">
            <input type="hidden" name="klantId" value="<?php echo $klantData['klantId']; ?>">
            <div class="mb-3">
                <label for="klantnaam" class="form-label">Klantnaam:</label>
                <input type="text" id="klantnaam" name="klantnaam" class="form-control" value="<?php echo $klantData['klantnaam']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $klantData['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefoonnummer" class="form-label">Telefoonnummer:</label>
                <input type="text" id="telefoonnummer" name="telefoonnummer" class="form-control" value="<?php echo $klantData['telefoonnummer']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Bijwerken</button>
            <a href="klant-overzicht.php" class="btn btn-secondary">Terug naar overzicht</a>
        </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Klant niet gevonden!</div>
        <?php endif; ?>
    </div>
</body>

</html>
