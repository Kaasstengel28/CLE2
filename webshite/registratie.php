<?php

if (isset($_POST['submit'])) {
    require_once "database/database.php";

    /** @var mysqli $db */

    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    $username = $_POST['username'];

//al zijn een of meerdere velden leeg dan komen er errors
    $errors = [];
    if ($username == '') {
        $errors['username'] = 'gebruikersnaam mag niet leeg blijven';
    }
    if ($email == '') {
        $errors['email'] = 'email mag niet leeg zijn';
    }
    if ($password == '') {
        $errors['password'] = 'wachtwoord mag niet leeg zijn';
    }
//als er geen errors zijn gaat hij door en voegt hij alles toe in de database
    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO accounts (username, email, password) VALUES ('$username','$email', '$password')";
        $result = mysqli_query($db, $query)
        or die('Db Error: ' . mysqli_error($db) . ' with query: ' . $query);
//als het klaar is stuurt hij je naar de login pagina
        if ($result) {
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<!zelfde als alle andere pagina's>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

<!hier begint de registratie sectie>
<section>
    <h2>Nieuwe gebruiker registeren</h2>
    <form action="" method="post">
        <div class="data-field">
            <label for="username">gebruikersnaam</label>
            <input id="username" type="text" name="username" value="<?= isset($username) ? $username : '' ?>"/>
            <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="email">email</label>
            <input id="email" type="email" name="email" value="<?= isset($email) ? $email : '' ?>"/>
            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="password">wachtwoord</label>
            <input id="password" type="password" name="password" value="<?= isset($password) ? $password : '' ?>"/>
            <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div class="data-submit">
            <input type="submit" name="submit" value="Registreren"/>
        </div>
    </form>
</section>
</body>
</html>
