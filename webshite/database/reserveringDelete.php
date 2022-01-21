<?php

//roept de database op
require_once 'database.php';
/** @var mysqli $db */

//haalt het id op en checkt hem
if (!isset ($_GET['id']) || $_GET['id'] === "") {
    header('Location: ../reserveringsoverzicht.php');
    exit;
}
//slaat het id op in een variable
$reserveringsId = mysqli_escape_string($db, $_GET['id']);

//hier delete hij de matchende rij van het id
$query = "DELETE FROM reserveringen WHERE id = '$reserveringsId'";

$result = mysqli_query($db, $query)
or die('Error: ' . mysqli_error($db) . ' - Query: ' . $query);

//sluit de connectie met de database
mysqli_close($db);

header('Location: ../reserveringsoverzicht.php');