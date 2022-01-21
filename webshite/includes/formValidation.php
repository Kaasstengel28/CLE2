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
    $errors['desctription'] = 'De Beschrijving mag niet leeg zijn';
}
if ($amount > 999) {
    $errors['amount'] = 'de hoeveelheid van het product mag niet hoger zijn dan 999';
}

