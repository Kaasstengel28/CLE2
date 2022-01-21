<?php
session_start();
//her checkt hij of je al bent ingelogt
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
} else {
    $login = false;
}

/** @var mysqli $db */
//hier roept de database op
require_once "database/database.php";
//hier worden de variables gemaakt
if (isset($_POST['submit'])) {
    $username = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
//al zijn ze leeg komen er errors
    $errors = [];
    if ($username == '') {
        $errors['email'] = 'Voer een gebruikersnaam in';
    }
    if ($password == '') {
        $errors['password'] = 'Voer een wachtwoord in';
    }
// al zijn er geen errors dan pakt hij dingen uit de database
    if (empty($errors)) {
        $query = "SELECT * FROM accounts WHERE username='$username'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $login = true;
//als alles klaar is wordt je ingelogt
                $_SESSION['loggedInUser'] = [
                    'email' => $user['email'],
                    'id' => $user['id']
                ];
            } else {
                $errors['loginFailed'] = 'De combinatie van gebruikersnaam en wachtwoord is niet goed';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>3donniedoos</title>
    <link rel="stylesheet" href="css/default.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="css/specific.css?v=<?= time(); ?>">
</head>

<div class="sidenav">
    <div><a href="landingpage.html">home</a></div>
    <div><a href="products.php">producten</a></div>
    <div><a href="aboutus.html">about us</a></div>
    <div><a href="contact.html">contact</a></div>
    <div><a href="login.php">log in</a></div>
    <div><a href="reserveringsoverzicht.php">reserveringen ADMIN</a></div>
    <div><a href="producteditor.php">product editor ADMIN</a></div>
</div>

<body style="background-image: url('imags/3997407.jpg');">

<section>
    <h2>Inloggen</h2>
    <!als je al bent ingelogt vertoont hij dit>
    <?php if ($login) { ?>
        <p>Je bent ingelogd!</p>
        <p><a href="logout.php">Uitloggen</a></p>
    <?php } else { ?>
        <!als niet dan vertoont het alles hieronder>

        <form action="" method="post">
            <div>
                <label for="gebruikersnaam">Gebruikersnaam</label>
                <input id="email" type="text" name="email" value="<?= isset($email) ? $email : '' ?>"/>
                <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
            </div>
            <div>
                <label for="password">Wachtwoord</label>
                <input id="password" type="password" name="password"/>
                <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
            </div>
            <div>
                <p class="errors"><?= isset($errors['loginFailed']) ? $errors['loginFailed'] : '' ?></p>
                <input type="submit" name="submit" value="Login"/>
                <br>
                nog geen account?<a href="registratie.php"> klik hier.</a>
            </div>
        </form>
    <?php } ?>
</section>

<footer>
    <p>Instagram</p>
    <p><a href="https://nl.wikipedia.org/wiki/Klaas-Jan_Huntelaar">klaas</a></p>
</footer>

</body>
</html>
