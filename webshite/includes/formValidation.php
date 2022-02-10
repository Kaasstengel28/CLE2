<?php
//hier checkt hij de informatie op dat het leeg is en het er correct in staat. Al is er iets leeg krijg je een error.
$errors = [];
if ($name == "") {
    $errors['name'] = 'De product naam mag niet leeg zijn';
}
if ($price == "") {
    $errors['price'] = 'De prijs mag niet leeg zijn';
}
if ($description == "") {
    $errors['description'] = 'De Beschrijving mag niet leeg zijn';
}
if ($amount == "") {
    $errors['amount'] = 'de hoevheid mag niet leeg zijn';
}
