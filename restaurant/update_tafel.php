<?php
include_once('./tafel.php');

$tafels = new Restaurant();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['tafel']) && !empty($_POST['stoelen']) && !empty($_POST['terras'])) {
        $tafelId = $_POST['TafelId']; 
        $tafel = $_POST['tafel'];
        $omschrijving = $_POST['stoelen'];
        $prijs = $_POST['terras'];
        
        $tafels->updatetafel($tafelId, $tafel, $omschrijving, $prijs); 
        echo '<div class="alert alert-success" role="alert">Tafel is succesvol bijgewerkt</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}

if(isset($_GET['TafelId'])) {
    $tafelId = $_GET['TafelId'];
    $TafelData = $tafels->gettafelById($tafelId);
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tafel bijwerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Tafel bijwerken</h1>
        <?php if (!empty($TafelData)) : ?>
        <form method="post">
            <input type="hidden" name="TafelId" value="<?php echo $TafelData['TafelId']; ?>"> <!-- Correct name attribute -->
            <div class="mb-3">
                <label for="tafel" class="form-label">tafels naam:</label>
                <input type="text" id="tafel" name="tafel" class="form-control" value="<?php echo $TafelData['tafel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stoelen" class="form-label"> aantal stoelen:</label>
                <input type="text" id="stoelen" name="stoelen" class="form-control" value="<?php echo $TafelData['stoelen']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="terras" class="form-label">Terras:</label>
                <select class="form-select" name="terras" id="terras">
                    <option value="JA" <?php if($TafelData['terras'] === 'JA') echo 'selected'; ?>>Ja</option>
                    <option value="Nee" <?php if($TafelData['terras'] === 'Nee') echo 'selected'; ?>>Nee</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Bijwerken</button>
            <a href="tafel-overzicht.php" class="btn btn-secondary">Terug naar overzicht</a>
        </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Tafel niet gevonden!</div>
        <?php endif; ?>
    </div>
</body>

</html>
