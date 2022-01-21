<?php
//Eerst definieert hij de DB variable zodat er geen kringeltjes onder zitten sinds die mij irriteren, is anders niet nodig.
//Daarna roept hij de database connectie op.
/** @var $db */
require_once "database/database.php";

//hier pakt hij de informatie van de database en slaat hj dat op in een variable
$query = "SELECT * FROM producten";
$result = mysqli_query($db, $query);

//hier pakt hij die variabele en zet hij het in een array
$producten = [];
while ($row = mysqli_fetch_assoc($result)) {
    $producten[] = $row;
}
//als laatste sluit hij de database.
mysqli_close($db);
?>

<!hier staat de titel van de site en wordt er een connectie met de stylesheets gemaakt.>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>3donniedoos</title>
    <link rel="stylesheet" href="css/default.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="css/specific.css?v=<?= time(); ?>">
</head>
<!php wordt bij de stylesheets gebruikt zodat de zij in real time updaten sinds ik daar problemen mee had>
<!de achtergrond wordt hier bepaald in de body tag sinds ik eerder problemen had met de css die niet wouw updaten zonder
dat ik dat realiseerde>
<body style="background-image: url('imags/3997407.jpg');">
<!dit is voor de side navigatie bar>
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
        <h2>
            product editor
        </h2>

        <table>
            <thead> <!de bovenste rij van de tabel wordt hier gedefinieerd>
            <tr>
                <th>#</th>
                <th>naam</th>
                <th>prijs</th>
                <th>beschijving</th>
                <th>hoeveelheid</th>
                <th colspan="1"></th>
            </tr>
            </thead>
            <tbody> <!hier is de inhoud van de tabel die er wordt ingevoegd door php>
            <?php foreach ($producten as $product) { ?>
                <tr>
                    <td> <?= $product['id'] ?> </td>
                    <td> <?= $product['name'] ?> </td>
                    <td> <?= $product['price'] ?> </td>
                    <td> <?= $product['description'] ?> </td>
                    <td> <?= $product['amount'] ?> </td>
                    <td><a href="database/Edit.php?id=<?= $product['id'] ?>">edit</a></td>
                    <td><a href="database/delete.php?id=<?= $product['id'] ?>">delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <br>
        creëer een nieuw <a href="database/create.php">product</a>
    </section>

</main>
<!footer met de informatie daarin>
<footer>
    <p>Instagram</p>
    <p><a href="https://nl.wikipedia.org/wiki/Klaas-Jan_Huntelaar">klaas</a></p>
</footer>

</body>
</html>