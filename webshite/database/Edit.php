<?php
session_start();
//hier maakt het een connectie met database
require_once "database.php";

//hier definieert hij de database zodat er geen krinkel lijntjes onder komen omdat ik daar niet tegen kan (is optioneel)
/** @var mysqli $db */

//hier checkt hij of er een id is en als niet wordt je terug gestuurd naar de producteditor
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: producteditor.php');
    exit;
}
//hier wort de id opgeslagen in een variabele
$productId = $_GET['id'];

//hier pakt hij alle data van de juiste rij doormiddel van het Id van het product.
//dit hier is voor de edit pagina zodat het de oude data kan onthouden.
$editQuery = "SELECT * FROM producten WHERE id = '$productId'";
$editResult = mysqli_query($db, $editQuery);

//hier wordt de net gepakte data opgeslagen in een array voor later gebruik.
$memory = mysqli_fetch_assoc($editResult);

//hier checkt hij of er dingen in staan als je op submit drukt
if (isset($_POST['submit'])) {

    //hier worden al de ingevulde variabelen gecheckt en alle tekens worden veranderd zodat er geen gemik mak kan plaats vinden.
    $name = mysqli_escape_string($db, $_POST['name']);
    $price = mysqli_escape_string($db, $_POST['price']);
    $description = mysqli_escape_string($db, $_POST['description']);
    $amount = mysqli_escape_string($db, $_POST['amount']);


    //hier wordt de form valitdatie op gehaalt (werkt dit keer)
    require_once "../includes/formValidation.php";

    //hier wordt er gecheckt of er wat velden zijn leeg gelaten en zo ja wordt de form validation gebruikt.
    if (empty($errors)) {
        //hier wordt de nieuwe data in de database gestopt
        $query = "UPDATE producten
                  SET name='$name', price='$price', description='$description', amount='$amount'
                  WHERE id = " . $productId;
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
//als het goed gaat stuurt hij je terug naar de producteditor.
        if ($result) {
            header('Location: ../producteditor.php');
            exit;
//als niet dan krijg je een error.
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }


        //connectie sluiten
        mysqli_close($db);
    }
}
?>
<!hier begint het formulier>
<form action="" method="post" enctype="multipart/form-data">

    <div class="data-field">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?= $memory ['name'] ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="price">Price</label>
        <input id="price" type="number" name="price" value="<?= $memory ['price'] ?>"/>
        <span class="errors"><?= isset($errors['price']) ? $errors['price'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="<?= $memory ['description'] ?>"/>
        <span class="errors"><?= isset($errors['description']) ? $errors['description'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="amount">Amount</label>
        <input id="amount" type="number" name="amount" value="<?= $memory ['amount'] ?>"/>
        <span class="errors"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
    </div>

    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>

</form>
<div>
    <a href="../producteditor.php">Go back to the list</a>
</div>
