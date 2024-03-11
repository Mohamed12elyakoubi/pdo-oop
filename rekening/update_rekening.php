<?php
include_once 'rekening.php';
include_once '../reservering/reservering.php';
include_once '../product/product.php';
include_once '../klant/klant.php';

$rekening = new Rekening();
$producten = new Product();
$reservering = new Reservering();
$klant = new Klant();

$rekening_id = $_GET['bestelling_id'];
$rekening_details = $rekening->get_rekening_by_id($rekening_id);

$product = $producten->selectAll();
$klanten = $klant->selectAll();
$reserveringData = $reservering->selectAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['ReserveringID']) && !empty($_POST['klant_id'])  && !empty($_POST['tafel_id']) && !empty($_POST['product_id']) && !empty($_POST['omschrijving']) && !empty($_POST['datum']) && !empty($_POST['tijd']) && !empty($_POST['aantal']) && !empty($_POST['Prijs']) && !empty($_POST['totaal_prijs'])) {
        $ReserveringID = $_POST['ReserveringID'];
        $klant_id = $_POST['klant_id'];
        $tafel_id = $_POST['tafel_id'];
        $product_id = $_POST['product_id'];
        $omschrijving = $_POST['omschrijving'];
        $datum = $_POST['datum'];
        $tijd = $_POST['tijd'];
        $aantal = $_POST['aantal'];
        $Prijs = $_POST['Prijs'];
        $totaal_prijs = $_POST['totaal_prijs'];


        $datums = date('Y-m-d');
        $tijden = date('H:i:s');
        $rekening->updateRekening($rekening_id, $ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal, $Prijs, $totaal_prijs);
        echo '<div class="alert alert-success" role="alert">Bestelling is succesvol bijgewerkt</div>';
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
    <title>Update Bestelling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../navbar.js" defer></script>
</head>

<body>
    <nav id="navbar"></nav> <br>

    <div class="container">
        <h1 class="mt-5 mb-4">Update Bestelling</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="ReserveringID">Reservering ID:</label>
                <div class="input-group">
                    <select class="form-control" name="ReserveringID" id="ReserveringID">
                        <?php foreach ($reserveringData as $reserveringItem) : ?>
                            <option value="<?php echo $reserveringItem['ReserveringID']; ?>" <?php if ($reserveringItem['ReserveringID'] == $rekening_details['ReserveringID']) echo 'selected'; ?>><?php echo $reserveringItem['ReserveringID']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="klant_id">Klant:</label>
                <input type="text" class="form-control" name="klant_id" id="klant_id" value="<?php echo $rekening_details['klant_id']; ?>">
            </div>

            <div class="form-group">
                <label for="tafel_id">Tafel ID:</label>
                <input type="text" class="form-control" name="tafel_id" id="tafel_id" value="<?php echo $rekening_details['tafel_id']; ?>">
            </div>

            <div class="form-group">
                <label for="product_id">Product ID:</label>
                <div class="input-group">
                    <select class="form-control" name="product_id" id="product_id">
                        <?php foreach ($product as $productItem) : ?>
                            <option value="<?php echo $productItem['productid']; ?>" <?php if ($productItem['productid'] == $rekening_details['product_id']) echo 'selected'; ?>><?php echo $productItem['productid'] . ' - ' . $productItem['product']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="omschrijving">Omschrijving:</label>
                <input type="text" class="form-control" name="omschrijving" id="omschrijving" value="<?php echo $rekening_details['omschrijving']; ?>">
            </div>

            <input type="text" class="form-control" name="datum" id="datum" value="<?php echo date('Y-m-d'); ?>" readonly hidden>
            <input type="text" class="form-control" name="tijd" id="tijd" value="<?php echo date('H:i:s'); ?>" readonly hidden>


            <div class="form-group">
                <label for="aantal">Aantal:</label>
                <input type="text" class="form-control" name="aantal" id="aantal" value="<?php echo $rekening_details['aantal']; ?>">
            </div>

            <div class="form-group">
                <label for="Prijs">Prijs:</label>
                <input type="text" class="form-control" name="Prijs" id="Prijs" value="<?php echo $rekening_details['Prijs']; ?>">
            </div>

            <div class="form-group">
                <label for="totaal_prijs">Totale Prijs:</label>
                <input type="text" class="form-control" name="totaal_prijs" id="totaal_prijs" value="<?php echo $rekening_details['totaal_prijs']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Bestelling</button>
        </form>
    </div>
</body>

</html>