<?php
//hier checkt hij de informatie van de reservering.
if ($amountOrdered > 10) {
    $errors['amountOrdered'] = 'de hoeveelheid reserveringen mag niet hoger zijn dan 10';
}

