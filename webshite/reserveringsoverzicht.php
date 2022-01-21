<?php
//hij roept de database op
/** @var $db */
require_once "database/database.php";

//hij selecteert alle data van de database
$query = "SELECT * FROM reserveringen";
$result = mysqli_query($db, $query);

//hij zet alles in een nieuwe aray
$reserveringen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}
//hij stopt de connectie
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<!zelfde als alle andere pagina's>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href=""/>
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
    <section>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>accountnaam</th>
                <th>datum besteld</th>
                <th>kwantiteit</th>
                <th>productId</th>
                <th>afronden</th>
                <th colspan="1"></th>
            </tr>
            </thead>
            <!hier zet hij alles in een nieuwe tabel>
            <tbody>
            <?php foreach ($reserveringen as $reservering) { ?>
                <tr>
                    <td> <?= $reservering['id'] ?> </td>
                    <td> <?= $reservering['accountName'] ?> </td>
                    <td> <?= $reservering['dateOrdered'] ?> </td>
                    <td> <?= $reservering['amountProduct'] ?> </td>
                    <td> <?= $reservering['productId'] ?> </td>
                    <td><a href="database/reserveringDelete.php?id=<?= $reservering['id'] ?>">Afronden</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>Instagram</p>
    <p><a href="https://nl.wikipedia.org/wiki/Klaas-Jan_Huntelaar">klaas</a></p>
</footer>

</body>
</html>