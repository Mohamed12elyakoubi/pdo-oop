<?php
include_once('./product.php');

if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $product = new Product();
    $product->deleteproduct($productid);
    header("Location: product-overzicht.php");
    exit();

} else {
    echo "Geen tafel ID opgegeven.";
}
?>