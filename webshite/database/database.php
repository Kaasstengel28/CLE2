<?php
// hier connect hij met de database, in dit geval "reserveringen" waarbij de host mijn eigen locale server is met geen wachtwoord
$host = "localhost";
$database = "reserveringen";
$user = "root";
$password = "";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());

