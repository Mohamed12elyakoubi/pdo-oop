<?php
include_once('./product.php');

$productObj = new Product();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['product']) && !empty($_POST['omschrijving']) && !empty($_POST['soort']) && !empty($_POST['prijs'])) {
        $productid = $_POST['productid'];
        $product = $_POST['product'];
        $omschrijving = $_POST['omschrijving'];
        $soort = $_POST['soort'];
        $prijs = $_POST['prijs'];
        
        $productObj->updateproduct($productid, $product, $omschrijving, $soort , $prijs);
        echo '<div class="alert alert-success" role="alert">Product is succesvol bijgewerkt</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Alle velden zijn verplicht!</div>';
    }
}

if(isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $productdata = $productObj->getproductbyid($productid);
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product bijwerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Product bijwerken</h1>
        <?php if (!empty($productdata)) : ?>
        <form method="post">
            <input type="hidden" name="productid" value="<?php echo $productdata['productid']; ?>">
            <div class="mb-3">
                <label for="product" class="form-label">product:</label>
                <input type="text" id="product" name="product" class="form-control" value="<?php echo $productdata['product']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="omschrijving" class="form-label">omschrijving:</label>
                <input type="text" id="omschrijving" name="omschrijving" class="form-control" value="<?php echo $productdata['omschrijving']; ?>" required>
            </div>
            <div class="mb-3">
            <label for="soort" class="form-label">soort:</label>
                <select class="form-select" name="soort" id="soort">
                <option value="" disabled selected>Kies een soort uit :</option>
                <option value="Drinken">Drinken</option>
                <option value="Maaltijd">Maaltijd</option>
                <option value="nagerecht">nagerecht</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="prijs" class="form-label">prijs:</label>
                <input type="number" step="any" id="prijs" name="prijs" class="form-control" value="<?php echo $productdata['prijs']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Bijwerken</button>
            <a href="product-overzicht.php" class="btn btn-secondary">Terug naar overzicht</a>
        </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Product niet gevonden!</div>
        <?php endif; ?>
    </div>
</body>

</html>
