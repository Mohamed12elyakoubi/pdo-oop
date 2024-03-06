<?php
include_once 'rekening.php';
include_once '../reservering/reservering.php';
include_once '../product/product.php';
include_once '../klant/klant.php';

$rekening = new Rekening();
$producten = new Product();
$reservering = new Reservering();
$klant = new Klant();

$product = $producten->selectAll();
$klanten = $klant->selectAll();
$reserveringData = $reservering->selectAll();

$datum = date('Y-m-d');
$tijd = date('H:i:s');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fetchReservationData'])) {
        $ReserveringID = $_POST['ReserveringID'];
        $reservering_details = $reservering->get_reservering_by_id($ReserveringID);
        echo json_encode($reservering_details);
        exit;
    } elseif (isset($_POST['fetchProductData'])) {
        $productID = $_POST['product_id'];
        $product_details = $producten->getProductById_bestelling($productID);
        echo json_encode($product_details);
        exit;
    } elseif (!empty($_POST['ReserveringID']) && !empty($_POST['klant_id'])  && !empty($_POST['tafel_id']) && !empty($_POST['product_id']) && !empty($_POST['omschrijving']) && !empty($_POST['datum']) && !empty($_POST['tijd']) && !empty($_POST['aantal']) && !empty($_POST['Prijs'])) {
        $ReserveringID = $_POST['ReserveringID'];
        $klant_id = $_POST['klant_id'];
        $tafel_id = $_POST['tafel_id'];
        $product_id = $_POST['product_id'];
        $omschrijving = $_POST['omschrijving'];
        $datums = $_POST['datum'];
        $tijden = $_POST['tijd'];
        $aantal = $_POST['aantal'];
        $Prijs = $_POST['Prijs'];

        $rekening->insertrekening($ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal, $Prijs);
        echo '<div class="alert alert-success" role="alert">Reservering is succesvol toegevoegd</div>';
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
    <title>Voeg een Bestelling toe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../navbar.js" defer></script>
</head>

<body>
    <nav id="navbar"></nav> <br>

    <div class="container">
        <h1 class="mt-5 mb-4">Overzicht</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class='table-light'>bestelling_id</th>
                    <th class='table-light'>ReserveringID </th>
                    <th class='table-light'>Klant </th>
                    <th class='table-light'>Tafel</th>
                    <th class='table-light'>Product</th>
                    <th class='table-light'>Omschrijving</th>
                    <th class='table-light'>Datum</th>
                    <th class='table-light'>Tijd</th>
                    <th class='table-light'>Aantal</th>
                    <th class='table-light'>Prijs</th>
                    <th class='table-light' colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rekeningen = $rekening->selectAll();
                foreach ($rekeningen as $rekening) {
                    echo "<tr>";
                    echo "<td>" . $rekening['bestelling_id'] . "</td>";
                    echo "<td>" . $rekening['ReserveringID'] . "</td>";
                    echo "<td>" . $rekening['klant_id'] . "</td>";
                    echo "<td>" . $rekening['tafel_id'] . "</td>";
                    echo "<td>" . $rekening['product_id'] . "</td>";
                    echo "<td>" . $rekening['omschrijving'] . "</td>";
                    echo "<td>" . $rekening['tijd'] . "</td>";
                    echo "<td>" . $rekening['aantal'] . "</td>";
                    echo "<td>" . $rekening['Prijs'] . "</td>";


                    echo "<td><a href='update_rekening.php?bestelling_id={$rekening['bestelling_id']}' class='btn btn-info'>Bewerken</a></td>";
                    echo "<td><a href='delete_rekening.php?bestelling_id={$rekening['bestelling_id']}' class='btn btn-danger'>verwijderen</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <div class="container">
        <h2>Voeg een Bestelling toe</h2> <br>
        <form method="POST" action="">
            <div class="form-group">
                <label for="ReserveringID">Reservering ID:</label>
                <div class="input-group">
                    <select class="form-control" name="ReserveringID" id="ReserveringID">
                        <?php foreach ($reserveringData as $reserveringItem) : ?>
                            <option value="<?php echo $reserveringItem['ReserveringID']; ?>"><?php echo $reserveringItem['ReserveringID']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-outline-secondary" onclick="fetchReservationData()">Zoeken</button>
                </div>
            </div>

            <div class="form-group">
                <label for="klant_id">Klant:</label>
                <input type="text" class="form-control" name="klant_id" id="klant_id" readonly>
            </div>

            <div class="form-group">
                <label for="tafel_id">Tafel ID:</label>
                <input type="text" class="form-control" name="tafel_id" id="tafel_id" readonly>
            </div>

            <div class="form-group">
                <label for="product_id">Product ID:</label>
                <div class="input-group">
                    <select class="form-control" name="product_id" id="product_id">
                        <?php foreach ($product as $productItem) : ?>
                            <option value="<?php echo $productItem['productid']; ?>"><?php echo $productItem['productid'];echo '---';echo $productItem['product'];  ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-outline-secondary" onclick="fetchProductData()">Zoeken</button>
                </div>
            </div>

            <div class="form-group">
                <label for="omschrijving">Omschrijving:</label>
                <input type="text" class="form-control" name="omschrijving" id="omschrijving">
            </div>

            <input type="text" class="form-control" name="datum" id="datum" value="<?php echo date('Y-m-d'); ?>" readonly hidden>
            <input type="text" class="form-control" name="tijd" id="tijd" value="<?php echo date('H:i:s'); ?>" readonly hidden>

            <div class="form-group">
                <label for="aantal">Aantal:</label>
                <input type="text" class="form-control" name="aantal" id="aantal">
            </div>

            <div class="form-group">
                <label for="Prijs">Prijs:</label>
                <input type="text" class="form-control" name="Prijs" id="Prijs">
            </div>
            <br>
            <button type="submit" class="btn btn-success" name="submit">Bestelling Toevoegen</button>
        </form>
    </div>

    <script>
        function fetchReservationData() {
            var reserveringID = document.getElementById('ReserveringID').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('klant_id').value = data.klantId + ' - ' + data.klantnaam + ' - ' + data.email;
                    document.getElementById('tafel_id').value = data.Tafel + ' - ' + data.tafel;
                }
            };
            xhr.send('ReserveringID=' + reserveringID + '&fetchReservationData=true');
        };

        function fetchProductData() {
            var productID = document.getElementById('product_id').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('omschrijving').value = data.omschrijving;
                    document.getElementById('Prijs').value = data.prijs;
                }
            };
            xhr.send('product_id=' + productID + '&fetchProductData=true');
        };
    </script>
</body>

</html>
