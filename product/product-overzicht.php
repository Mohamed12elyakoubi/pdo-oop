<?php
include_once('./product.php');
$Product = new Product();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['product']) && !empty($_POST['omschrijving']) && !empty($_POST['soort']) && !empty($_POST['prijs'])) {
        $product = $_POST['product'];
        $omschrijving = $_POST['omschrijving'];
        $soort = $_POST['soort'];
        $prijs = $_POST['prijs'];
        $Product->insertproduct($product, $omschrijving, $soort , $prijs);
        echo '<div class="alert alert-success" role="alert">Product is succesvol toegevoegd</div>';
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
    <title>view products</title>
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
                    <th class='table-light'>productID</th>
                    <th class='table-light'>product</th>
                    <th class='table-light'>omschrijving</th>
                    <th class='table-light'>soort</th>
                    <th class='table-light'>prijs</th>
                    <th class='table-light' colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Producten = $Product->selectAll();
                    foreach ($Producten as $Product) {
                        echo "<tr>";
                        echo "<td>" . $Product['productid'] . "</td>";
                        echo "<td>" . $Product['product'] . "</td>";
                        echo "<td>" . $Product['omschrijving'] . "</td>";
                        echo "<td>" . $Product['soort'] . "</td>";
                        echo "<td>" . "€" . $Product['prijs'] . "</td>";
                        echo "<td><a href='update_product.php?productid={$Product['productid']}' class='btn btn-info'>Bewerken</a></td>";
                        echo "<td><a href='delete_product.php?productid={$Product['productid']}' class='btn btn-danger'>verwijderen</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <h2 class="mb-3">Voeg een nieuwe product toe</h2>
        <form method="post">
            <div class="mb-3">
                <label for="product" class="form-label">product:</label>
                <input type="text" id="product" name="product" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="omschrijving" class="form-label">omschrijving</label>
                <input type="text" id="omschrijving" name="omschrijving" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="soort" class="form-label">soort:</label>
                <select class="form-select" name="soort" id="soort">
                <option value="" disabled selected>select een een type</option>
                <option value="Drinken">Drinken</option>
                <option value="Maaltijd">Maaltijd</option>
                <option value="nagerecht">nagerecht</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="prijs" class="form-label">prijs:</label>
                <input  type="number" step="any" id="prijs" name="prijs" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Voeg Product toe</button>
            <br>
            
        </form>
    </div>


</body>

</html>