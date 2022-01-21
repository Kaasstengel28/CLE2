<?php
//hier roept hij de database op
/** @var $db */
require_once "database/database.php";

//hier selecteert hij de producten
$query = "SELECT * FROM producten";
$result = mysqli_query($db, $query);

//hier zet hij de producten in een nieuwe array
$producten = [];
while ($row = mysqli_fetch_assoc($result)) {
    $producten[] = $row;
}
//hier sluit hij de connectie
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
    <!hier start een speciale sectie voor de producten
    <section class="producten">
        <h2>
            Producten
        </h2>
        <p> <!hier maakt hij producten kaarten aan per ieder product wat is gecreëerd.
        <div class="card">
            <?php foreach ($producten

            as $product) { ?>
            <img src="imags/dawg%20big.PNG" alt="doos 1" style="width:100%">
            <h1><?= $product['name'] ?></h1>
            <p class="price">$<?= $product['price'] ?></p>
            <p><?= $product['description'] ?></p>
            <p> <!de knop die lijdt naar de product details>
                <button><a href="product.php?id=<?= $product['id'] ?>">Meer info</a></button>
            </p>
        </div>
        <div class="card">
            <?php } ?>
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