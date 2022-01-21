<?php
//hij roept de database op
/** @var $db */
require_once "database/database.php";

//al vindt hij geen Id wordt je terug naar de productpagina gestuurd
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: products.php');
    exit;
}
//hier pakt hij de id en zet hij hem in een variabele
$productId = $_GET['id'];

//hier pakt hij de informatie van de database waarbij de product id matcht
$query = "SELECT * FROM producten WHERE id = " . $productId;
$result = mysqli_query($db, $query);

//als het niet bestaat wordt je terug naar de producten pagina gestuurt
if (mysqli_num_rows($result) == 0) {
    header('Location: products.php');
    exit;
}
//hiet zet hij alles in een nieuwe array
$product = mysqli_fetch_assoc($result);

//hie sluit hij de connectie
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<!zelfde als alle andere pagina's>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>3donniedoos</title>
    <link rel="stylesheet" href="css/default.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="css/specific.css?v=<?= time(); ?>">
</head>
<!zelfde als alle andere pagina's>
<body style="background-image: url('imags/3997407.jpg');">
<!zelfde als alle andere pagina's>
<div class="sidenav">
    <div><a href="landingpage.html">home</a></div>
    <div><a href="products.php">producten</a></div>
    <div><a href="aboutus.html">about us</a></div>
    <div><a href="contact.html">contact</a></div>
    <div><a href="login.php">log in</a></div>
    <div><a href="reserveringsoverzicht.php">reserveringen ADMIN</a></div>
    <div><a href="producteditor.php">product editor ADMIN</a></div>
</div>

<main>
    <!hier begint de speciale producten pagina>
    <section class="productDetails">
        <h2> <!de titel van de pagina>
            <?= $product['name'] ?>
        </h2>
        <div class="flex-container">
            <!in de eerste flexbox wordt de foto van de doos herhaalt>
            <div class="flex-child magenta">
                <img src="imags/dawg%20big.PNG" alt="doos 1" style="width:100%">
            </div>
            <!in de tweede flexbox worden de andere details en de reserverings knop gezet.
            <div class="flex-child green">
                Beschrijving:<br> <br>
                <?= $product['description'] ?>
                <br> <br>
                prijs:<?= $product['price'] ?>
                <br><br>
                <button><a href="reserveren.php?id=<?= $product['id'] ?>">reserveren</a></button>
            </div>
        </div>
    </section>
</main>

<!zelfde als alle andere pagina's>
<footer>
    <p>Instagram</p>
    <p><a href="https://nl.wikipedia.org/wiki/Klaas-Jan_Huntelaar">klaas</a></p>
</footer>

</body>
</html>