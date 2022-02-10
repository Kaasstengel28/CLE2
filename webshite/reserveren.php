<?php
session_start();
//hier checkt hij voor de email van een ingelogt persoon, al is er niet ingelogt wordt je gestuurd naar de log in pagina
$email = $_SESSION['loggedInUser']['email'];
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    //hier roept hij de database op
    require_once "database/database.php";

    //hier maakt hij alle variabelen aan
    $accountName = $email;
    $dateOrdered = date("F j, Y, g:i a");
    $amountProduct = mysqli_escape_string($db, $_POST['amountProduct']);

    $productId = mysqli_escape_string($db, $_GET['id']);

    //hierzo roept hij de form validation op
    require_once "includes/formValidationReserveren.php";

    //en hier slaat hij het op in de database
    if (empty($errors)) {
        $query = "INSERT INTO reserveringen (accountName, dateOrdered, amountProduct, productId )
                  VALUES ('$accountName', '$dateOrdered', '$amountProduct', '$productId' )";
        $result = mysqli_query($db, $query)
        or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
//al is alles gelukt stuurt hij je door naar de reservering gelukt pagina. als niet dan krijg je een error
        if ($result) {
            header('Location: reserveringGelukt.pog.php');
            exit;

        } else {
            $errors['db'] = 'er is iets fout gegaan: ' . mysqli_error($db);
        }
        mysqli_close($db);
    }
}
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

    <section class="reserveren">
        <h2>
            Reserveren
        </h2>
        <! hier maakt hij een invul veld in voor de hoeveelheid die je wilt reserveren>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="data-field">
                <label for="amountProduct">Hoeveelheid</label>
                <input id="amountProduct" type="number" name="amountProduct"
                       value="<?= isset($amountProduct) ? htmlentities($amountProduct) : '' ?>"/>
                <span class="errors"><?= isset($errors['amountProduct']) ? $errors['amountProduct'] : '' ?></span>

            </div>
            <div class="data-submit">
                <input type="submit" name="submit" value="Save"/>
            </div>
    </section>
</main>

<footer>
    <p>Instagram</p>
    <p><a href="https://nl.wikipedia.org/wiki/Klaas-Jan_Huntelaar">klaas</a></p>
</footer>

</body>
</html>