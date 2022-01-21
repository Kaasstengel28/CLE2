<?php
if (isset($_POST['submit'])) {
    //hier roept hij de database op
    require_once "database.php";

//hier worden de variabelen gedefinieerd
    $name = mysqli_escape_string($db, $_POST['name']);
    $price = mysqli_escape_string($db, $_POST['price']);
    $description = mysqli_escape_string($db, $_POST['description']);
    $amount = mysqli_escape_string($db, $_POST['amount']);

    //hier roept hij de form validatie op
    require_once "../includes/formValidation.php";

    //hier slaat hij de informatie op in de database
    $query = "INSERT INTO producten (name, price, description, amount )
                  VALUES ('$name', '$price', '$description', '$amount')";
    $result = mysqli_query($db, $query)
    or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
//als het slaagt stuurt hij je terug naar de producteditor en als niet krijg je een error
    if ($result) {
        header('Location: ../producteditor.php');
        exit;

    } else {
        $errors['db'] = 'er is iets fout gegaan: ' . mysqli_error($db);
    }
    mysqli_close($db);
}
?>
<!hier begint het invul formulier>
<form action="" method="post" enctype="multipart/form-data">

    <div class="data-field">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="price">Price</label>
        <input id="price" type="text" name="price" value="<?= isset($price) ? htmlentities($price) : '' ?>"/>
        <span class="errors"><?= isset($errors['price']) ? $errors['price'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="description">Description</label>
        <input id="description" type="text" name="description"
               value="<?= isset($description) ? htmlentities($description) : '' ?>"/>
        <span class="errors"><?= isset($errors['description']) ? $errors['description'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="amount">Amount</label>
        <input id="amount" type="text" name="amount" value="<?= isset($amount) ? htmlentities($amount) : '' ?>"/>
        <span class="errors"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
    </div>

    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>

</form>
<div>
    <a href="../producteditor.php">Go back to the list</a>
</div>
