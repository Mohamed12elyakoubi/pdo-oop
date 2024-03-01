<?php
include_once("rekening.php");
include_once("../reservering/reservering.php");
include_once("../restaurant/tafel.php");

$restaurant = new Restaurant();
$reservering = new Reservering();
$rekening = new Rekening();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datum = date('Y-m-d');
    $tijd = date('H:i:s');
    print_r($_POST);

    if (!empty($_POST['tafel_id']) && !empty($_POST['afdeling']) && !empty($_POST['aantal']) &&
        !empty($_POST['omschrijving']) && !empty($_POST['prijs']) && !empty($_POST['Totaal']) &&
        !empty($_POST['BTW']) && !empty($_POST['incBTW']) && !empty($_POST['ExclBTW'])) {

        echo "Alle velden zijn ingevuld!";

        $tafel_id = $_POST['tafel_id'];
        $afdeling = $_POST['afdeling'];
        $aantal = $_POST['aantal'];
        $omschrijving = $_POST['omschrijving'];
        $prijs = $_POST['prijs'];
        $Totaal = $_POST['Totaal'];
        $BTW = $_POST['BTW'];
        $incBTW = $_POST['incBTW'];
        $ExclBTW = $_POST['ExclBTW'];

        $rekening->insertrekening($datum, $tijd, $tafel_id, $afdeling, $aantal, $omschrijving, $prijs, $Totaal, $BTW, $incBTW, $ExclBTW);
        echo "rekening is succesvol toegevoegd!";
    } else {
        echo "Alle velden zijn verplicht!";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening Formulier</title>
    <script src="../navbar.js" defer></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav id="navbar"></nav>

    <div class="container mt-5">
        <h2>Rekening Toevoegen</h2>
        <form method="post" >
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="datum">Datum:</label>
          <input type="text" id="datum" name="datum" value="<?php echo date('Y-m-d'); ?>" readonly class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tijd">Tijd:</label>
          <input type="text" id="tijd" name="tijd" value="<?php echo date('H:i:s'); ?>" readonly class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="tafel_id">Tafel ID:</label>
          <select class="form-control" id="tafel_id" name="tafel_id">
        <option value="1">Selecteer een tafel</option>
        <?php
            $restaurant = new Restaurant();
            $tafels = $restaurant->selectAll(); 
            foreach ($tafels as $tafel) {
                echo "<option value='" . $tafel['tafel_id'] . "'>" . $tafel['tafel'] . "</option>";
            }
        ?>
    </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="afdeling">Afdeling:</label>
          <input type="text" id="afdeling" name="afdeling" required class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="aantal">Aantal personen:</label>
          <input type="number" id="aantal" name="aantal" required class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="BTW">BTW:</label>
          <select id="BTW" name="BTW" required class="form-control">
            <option value="0.06">6%</option>
            <option value="0.21">21%</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="omschrijving">Omschrijving:</label>
          <textarea id="omschrijving" name="omschrijving" rows="5" cols="40" required class="form-control"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="prijs">Prijs per persoon:</label>
          <input type="number" id="prijs" name="prijs" step="0.01" required class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Verstuur</button>
      </div>
    </div>
  </div>
</form>

    </div>
    
</body>
</html>
