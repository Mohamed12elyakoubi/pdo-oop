<?php
include_once('./reservering.php');
include_once('../klant/klant.php');
include_once('../restaurant/tafel.php');

$reservering = new Reservering();

$klant = new Klant();
$klanten = $klant->selectAll();

$tafel = new Restaurant();
$tafels = $tafel->selectAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['ReserveringID']) && !empty($_POST['Tafel']) && !empty($_POST['klantId']) && !empty($_POST['start-reservering']) && !empty($_POST['einde-reservering'])) {
        $ReserveringID = $_POST['ReserveringID'];
        $Tafel = $_POST['Tafel'];
        $klantId = $_POST['klantId'];
        $startreservering = $_POST['start-reservering'];
        $eindereservering = $_POST['einde-reservering'];
        $reservering->updatereservering($ReserveringID, $Tafel, $klantId, $startreservering, $eindereservering);
        echo '<div class="alert alert-success" role="alert">Reservering is succesvol bijgewerkt</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}

if (isset($_GET['ReserveringID'])) {
    $ReserveringID = $_GET['ReserveringID'];
    $reserveringData = $reservering->get_reservering_by_id($ReserveringID);
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering bijwerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-left: auto;">
        <h1 class="mt-5 mb-4">Reservering bijwerken</h1>
        <?php if (!empty($reserveringData)) : ?>
            <form method="post">
                <input type="hidden" name="ReserveringID" value="<?php echo $reserveringData['ReserveringID']; ?>">
                <div class="mb-3">
                    <label for="Tafel" class="form-label">Tafel :</label>
                    <select class="form-select" name="Tafel" id="Tafel" required>
                        <?php foreach ($tafels as $tafel) : ?>
                            <option value="<?php echo $tafel['TafelId']; ?>" <?php if ($reserveringData['Tafel'] == $tafel['TafelId']) echo 'selected'; ?>><?php echo $tafel['tafel']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="klantId" class="form-label">Klant:</label>
                    <select class="form-select" name="klantId" id="klantId" required>
                        <?php foreach ($klanten as $klant) : ?>
                            <option value="<?php echo $klant['klantId']; ?>" <?php if ($reserveringData['klantId'] == $klant['klantId']) echo 'selected'; ?>><?php echo $klant['klantnaam']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="start-reservering">Start reservering:</label><br>
                    <input type="datetime-local" id="start-reservering" name="start-reservering" class="form-control" value="<?php echo $reserveringData['start-reservering']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="einde-reservering">Einde reservering:</label><br>
                    <input type="datetime-local" id="einde-reservering" name="einde-reservering" class="form-control" value="<?php echo $reserveringData['einde-reservering']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Bijwerken</button>
                <a href="reservering-overzicht.php" class="btn btn-secondary">Terug naar overzicht</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Reservering niet gevonden!</div>
        <?php endif; ?>
    </div>
</body>

</html>
