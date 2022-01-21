<?php
//connectie database
require_once 'database.php';
/** @var mysqli $db */

//hier haalt hij de id op en checkt hij deze
if (!isset ($_GET['id']) || $_GET['id'] === "") {
    header('Location: ../producteditor.php');
    exit;
}
//hier slaat hij de id op
$productId = mysqli_escape_string($db, $_GET['id']);

//hier delete hij de rij uit de tabel producten waarbij het producten id matcht.
$query = "DELETE FROM producten WHERE id = '$productId'";

$result = mysqli_query($db, $query)
or die('Error: ' . mysqli_error($db) . ' - Query: ' . $query);

mysqli_close($db);
//hier stuurt hij je terug naar de editor als alles klaar is
header('Location: ../producteditor.php');